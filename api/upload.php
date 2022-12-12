<?
/** @noinspection PhpUnhandledExceptionInspection */
define('NOT_CHECK_PERMISSIONS', true);

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";

require_once(__DIR__ . "/../vendor/autoload.php");
require_once(__DIR__ . "/../config.php");

use Bitrix\Main\Context;
use VAVT\Services\Postgres;
use VAVT\UP\RPDManager;
use VAVT\UP\UploadManager;

$request = Context::getCurrent()->getRequest();

$ch = \curl_init('http://172.16.10.90/1cuniver/hs/prepportal/syllabus');

if ($request->isPost()) {
    $res = \json_decode(\file_get_contents('php://input'), true)['res'];
} else {
    $syllabusNum = $request->getQuery('SN');
    $ch = \curl_init('http://172.16.10.90/1cuniver/hs/prepportal/syllabus');

    $options = [
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPAUTH => CURLAUTH_ANY,
        CURLOPT_USERPWD => 'obmen_users:rO3qomov',
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json'
        ],
        CURLOPT_POSTFIELDS => \json_encode(['SyllabusNum' => $syllabusNum])
    ];

    \curl_setopt_array($ch, $options);
    $res = \json_decode(\curl_exec($ch), true)['res'];
    $httpCode = \curl_getinfo($ch, CURLINFO_HTTP_CODE);
    \curl_close($ch);
}

$newStructure = [];

foreach ($res as $item) {

    foreach ($item['disciplineStructure'] as $number => $semester) {
        foreach ($semester as $type) {
            if ($type['type'] === 'Нагрузка') {
                $type['totalCount'] = $type['quantity'];
                $newStructure[$item['code']][$number]['load'][] = $type;
            } elseif ($type['type'] === 'Контроль') {
                $type['totalCount'] = $type['ZET'];
                $newStructure[$item['code']][$number]['control'][] = $type;
            }
        }
    }
}

$pdo = Postgres::getInstance()->connect('pgsql:host=' . DB_HOST . ';port=5432;dbname=' . DB_NAME . ';', DB_USER, DB_PASSWORD);

//селектим все дисциплины текущего УП и гасим отсутствующие
try {
    $sql = 'SELECT syllabus_id,code,kafedra,name FROM disciplines
                    WHERE syllabus_id = :syllabus_id';

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':syllabus_id', $res[0]['syllabusData']['syllabusID'], PDO::PARAM_STR);
    $stmt->execute();
    $selectRes = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (\PDOException $e) {
    echo $e->getMessage();
}

foreach ($res as $item) {
    foreach ($selectRes as $key => $selectItem) {
        if ($selectItem['code'] === $item['code'] && $selectItem['kafedra'] === $item['kafedra']) {
            unset($selectRes[$key]);
        }
    }
}

foreach ($selectRes as $item) {
    try {
        $sql = 'UPDATE disciplines SET actual = false
                    WHERE syllabus_id = :syllabus_id
                    AND code = :code
                    AND kafedra = :kafedra';

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':syllabus_id', $res[0]['syllabusData']['syllabusID'], PDO::PARAM_STR);
        $stmt->bindParam(':code', $item['code'], PDO::PARAM_STR);
        $stmt->bindParam(':kafedra', $item['kafedra'], PDO::PARAM_STR);
        $stmt->execute();

    } catch (\PDOException $e) {
        echo $e->getMessage();
    }
}

//добавляем и апдейтим актуальные дисциплины
foreach ($res as &$item) {
    $item['disciplineStructure'] = $newStructure[$item['code']];
    $um = new UploadManager($item);
    try {
        $sql = "INSERT INTO disciplines (syllabus_id,code,kafedra,name,last_change,json,actual,status)
                    VALUES(:syllabus_id,:code,:kafedra,:name,current_timestamp,:json,true,'blank')
                    ON CONFLICT (syllabus_id,code,kafedra)
                    DO
                       UPDATE SET(name,last_change,json,actual) = (:name,current_timestamp,:json,true)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':syllabus_id', $res[0]['syllabusData']['syllabusID'], PDO::PARAM_STR);
        $stmt->bindParam(':kafedra', $um->data['kafedra'], PDO::PARAM_STR);
        $stmt->bindParam(':code', $um->data['code'], PDO::PARAM_STR);
        $stmt->bindParam(':name', $um->data['name'], PDO::PARAM_STR);
        $stmt->bindParam(':json', \json_encode($um->data, JSON_UNESCAPED_UNICODE || JSON_PRETTY_PRINT), PDO::PARAM_STR);
        $stmt->execute();

    } catch (\PDOException $e) {
        echo $e->getMessage();
    }

}

try {
    $sql = 'INSERT INTO syllabuses (id,profile,special,qualification,entrance_year,syllabus_year,last_change,education_form,special_code,actual)
                    VALUES(:syllabus_id,:profile,:special,:qualification,:entrance_year,:syllabus_year,current_timestamp,:education_form,:special_code,true)
                    ON CONFLICT (id)
                    DO
                       UPDATE SET(last_change,syllabus_year,profile,special,entrance_year,qualification,education_form,special_code,actual)
                           = (current_timestamp,:syllabus_year,:profile,:special,:entrance_year,:qualification,:education_form,:special_code,true)';

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':syllabus_id', $res[0]['syllabusData']['syllabusID'], PDO::PARAM_STR);
    $stmt->bindParam(':profile', $res[0]['syllabusData']['profile'], PDO::PARAM_STR);
    $stmt->bindParam(':special', $res[0]['syllabusData']['special'], PDO::PARAM_STR);
    $stmt->bindParam(':entrance_year', $res[0]['syllabusData']['year'], PDO::PARAM_STR);
    $stmt->bindParam(':qualification', $res[0]['syllabusData']['educationLevel'], PDO::PARAM_STR);
    $stmt->bindParam(':syllabus_year', $res[0]['syllabusData']['syllabusYear'], PDO::PARAM_STR);
    $stmt->bindParam(':education_form', $res[0]['syllabusData']['formOfTraining'], PDO::PARAM_STR);
    $stmt->bindParam(':special_code', $res[0]['syllabusData']['specialCode'], PDO::PARAM_STR);
    $stmt->execute();

} catch (\PDOException $e) {
    echo $e->getMessage();
}

RPDManager::uploadUPToRemote($res[0]['syllabusData']['syllabusID']);

die(\json_encode(['success' => true]));

