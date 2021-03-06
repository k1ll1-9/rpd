<?php
require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";
require_once(__DIR__ . "/../vendor/autoload.php");

use VAVT\Services\Postgres;

$pdo = Postgres::getInstance()->connect('pgsql:host=172.16.10.59;port=5432;dbname=Syllabuses_test;', 'umd-web', 'klopik463');

//селектим все дисциплины текущего УП и гасим отсутствующие
try {
    $sql = 'SELECT * FROM disciplines_history';

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (\PDOException $e) {
    echo $e->getMessage();
}

foreach ($res as $rpd)  {

    $json = json_decode($rpd['json'],true);

    var_dump($json['informationalResources']);

    if (isset($json['informationalResources'])){
        $newRes = $json['informationalResources'];
        $newRes[3] = $json['informationalResources'][4];
        $newRes[4] = $json['informationalResources'][3];
/*        $newRes = [];
        $i = 1;

        foreach ($json['informationalResources'] as $name => $item) {
            $newRes[$i] = [
                'order' => $i,
                'name' => $name,
                'data' => $item
            ];
            $i++;
        }*/

        $json['informationalResources'] = $newRes;

        $data = \json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        try {
            $sql = 'INSERT INTO disciplines_history as dh (syllabus_id,code,kafedra,last_change,json)
                            VALUES (:syllabus_id,:code,:kafedra,current_timestamp,:data)
                            ON CONFLICT (syllabus_id,code,kafedra)
                            DO UPDATE
                            SET json = :data, last_change = current_timestamp
                            WHERE dh.syllabus_id = :syllabus_id
                                AND dh.code = :code
                                AND dh.kafedra = :kafedra';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':syllabus_id', $rpd['syllabus_id'], \PDO::PARAM_STR);
            $stmt->bindParam(':code', $rpd['code'], \PDO::PARAM_STR);
            $stmt->bindParam(':kafedra', $rpd['kafedra'], \PDO::PARAM_STR);
            $stmt->bindParam(':data', $data, \PDO::PARAM_STR);
            if ($stmt->execute()) {

                $res = ['success' => true];
            }
        } catch (\PDOException $e) {
            $res = ['error' => $e->getMessage()];
        }
    }



}
