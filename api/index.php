<?php
/** @global $USER */

use Bitrix\Main\Context;
use VAVT\Services\Postgres;

if (!$_SERVER['DOCUMENT_ROOT']) {
    $_SERVER['DOCUMENT_ROOT'] = '/home/bitrix/www';
}

define('NOT_CHECK_PERMISSIONS', true);

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";
require __DIR__ . '/RPDManager.php';

$request = Context::getCurrent()->getRequest();
$method = $request->getRequestMethod();

switch ($method) {
    case 'GET':
    {
        switch ($request->getQuery('action')) {
            case 'initApp':
            {

                $data['user'] = RPDManager::getUserInfo();

                die(\json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            }
            case 'getSyllabusesList':

                $res = RPDManager::getSyllabusesList();

                die(\json_encode($res, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

            case 'getRPDList':

                $params = $request->getQueryList()->toArray();
                $params = \json_decode($params['params'], true);

                $res['list'] = RPDManager::getRPDList($params);
                $res['syllabusFiles'] = RPDManager::getSyllabusFiles($params);
                die(\json_encode($res, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

            case 'getRPDData':
                $params = $request->getQueryList()->toArray();
                $params = \json_decode($params['params'], true);

                $res = RPDManager::getRPDFromDB($params);

                die(\json_encode($res, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        }
        break;
    }
    case 'POST' :
    {
        $contentType = $request->getHeader('content-type');
        if ($contentType === 'application/json') {
            $data = \json_decode(\file_get_contents('php://input'), true);
            switch ($data['action']) {
                case 'setData':
                    $res = RPDManager::setRPDData($data);
                    die(\json_encode($res));
                    break;
            }
        } else {
            switch ($request['action']) {
                case 'uploadSyllabusFile':
                    $params = \json_decode($request->getPost('params'), true);
                    $file = $request->getFile('file');

                    $originalYear = $params['year'];
                    $params['year'] = \date('d-m-Y', \strtotime($params['year']));
                    $fp = '/mnt/synology_nfs/syllabuses/' . \join('/', $params);
                    \mkdir($fp, 0775, true);
                    $fn = '/' . $file['name'];
                    $path = $fp . $fn;
                    \move_uploaded_file($file['tmp_name'], $path);

                    try {
                        $pdo = Postgres::getInstance()->connect('pgsql:host=172.16.10.59;port=5432;dbname=Syllabuses_test;', 'umd-web', 'klopik463');
                        $sql = "UPDATE syllabuses 
                            SET {$params['colName']} = array_append({$params['colName']}, :path)
                            WHERE profile = :profile
                                AND special = :special
                                AND entrance_year = :entrance_year
                                AND (:path <> ALL ({$params['colName']}) OR {$params['colName']} IS NULL)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':profile', $params['profile'], PDO::PARAM_STR);
                        $stmt->bindParam(':special', $params['special'], PDO::PARAM_STR);
                        $stmt->bindParam(':entrance_year', $originalYear, PDO::PARAM_STR);
                        $stmt->bindParam(':path', $path, PDO::PARAM_STR);
                        $stmt->execute();
                    } catch (\PDOException $e) {
                        echo $e->getMessage();
                    }
                    die(\json_encode([
                        'name' => $file['name'],
                        'path' => $path
                    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            }
            break;
        }
    }
}

