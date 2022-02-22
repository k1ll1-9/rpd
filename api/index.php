<?php

use Bitrix\Main\Context;
use VAVT\Services\Postgres;

if (!$_SERVER['DOCUMENT_ROOT']) {
    $_SERVER['DOCUMENT_ROOT'] = '/home/bitrix/www';
}
define('NOT_CHECK_PERMISSIONS', true);


require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";
require __DIR__ .'/RPDManager.php';

$request = Context::getCurrent()->getRequest();
$method = $request->getRequestMethod();

switch ($method) {
    case 'GET':
    {
        switch ($request->getQuery('action')) {
            case 'getData':

                $pdo = Postgres::getInstance()->connect('pgsql:host=172.16.10.59;port=5432;dbname=Syllabuses;', 'umd-web', 'klopik463');
                $params = $request->getQueryList()->toArray();
                $params = \json_decode($params['params'],true);

                try {
                    $sql = 'SELECT json FROM  disciplines 
                            WHERE (profile,special,year,name) = (:profile,:special,:year,:name) ';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':profile', $params['profile'], PDO::PARAM_STR);
                    $stmt->bindParam(':special', $params['special'], PDO::PARAM_STR);
                    $stmt->bindParam(':year', $params['year'], PDO::PARAM_STR);
                    $stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
                    $stmt->execute();
                    $res = $stmt->fetchColumn();
                    $staticData = \json_decode($res, true);
                } catch (\PDOException $e) {
                    echo $e->getMessage();
                }

                try {
                    $sql = 'SELECT json FROM  disciplines_history
                            WHERE (profile,special,year,name) = (:profile,:special,:year,:name) 
                            ORDER  BY last_change DESC NULLS 
                            LAST LIMIT 1 ';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':profile', $params['profile'], PDO::PARAM_STR);
                    $stmt->bindParam(':special', $params['special'], PDO::PARAM_STR);
                    $stmt->bindParam(':year', $params['year'], PDO::PARAM_STR);
                    $stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
                    $stmt->execute();
                    $res = $stmt->fetchColumn();
                    $managedData = \json_decode($res, true);
                } catch (\PDOException $e) {
                    echo $e->getMessage();
                }

                $data['static'] = $staticData;
                $data['managed'] = $managedData;

                RPDManager::getDisciplineValues($data);

                die(\json_encode($data));
        }
        break;
    }
    case 'POST' :
    {
        //axios использует поток 'php://input' вместо POST'а
        $request = \json_decode(\file_get_contents('php://input'), true);
        switch ($request['action']) {
            case 'setData':

                $data = \json_encode($request['data'], JSON_PRETTY_PRINT || JSON_UNESCAPED_UNICODE);
                $pdo = Postgres::getInstance()->connect('pgsql:host=172.16.10.59;port=5432;dbname=Syllabuses;', 'umd-web', 'klopik463');
                $params = $request['params'];

                try {
                    $sql = 'INSERT INTO disciplines_history as dh (profile,special,year,name,last_change)
                            VALUES (:profile,:special,:year,:name, current_timestamp)
                            ON CONFLICT (profile,special,year,name)
                            DO UPDATE
                            SET json = :data, last_change = current_timestamp
                            WHERE dh.profile = :profile
                                AND dh.special = :special
                                AND dh.year = :year
                                AND dh.name = :name';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':profile', $params['profile'], PDO::PARAM_STR);
                    $stmt->bindParam(':special', $params['special'], PDO::PARAM_STR);
                    $stmt->bindParam(':year', $params['year'], PDO::PARAM_STR);
                    $stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
                    $stmt->bindParam(':data', $data, PDO::PARAM_STR);
                    $stmt->execute();

                } catch (\PDOException $e) {
                    echo $e->getMessage();
                }
                die(\json_encode($stmt->errorInfo));
        }
    }
}
