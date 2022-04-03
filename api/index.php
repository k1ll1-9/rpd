<?php

use Bitrix\Main\Context;
use VAVT\Services\Postgres;

if (!$_SERVER['DOCUMENT_ROOT']) {
    $_SERVER['DOCUMENT_ROOT'] = '/home/bitrix/www';
}

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";
require __DIR__ .'/RPDManager.php';

$request = Context::getCurrent()->getRequest();
$method = $request->getRequestMethod();

switch ($method) {
    case 'GET':
    {
        switch ($request->getQuery('action')) {
            case 'getRPDData':

                $pdo = Postgres::getInstance()->connect('pgsql:host=172.16.10.59;port=5432;dbname=Syllabuses_test;', 'umd-web', 'klopik463');
                $params = $request->getQueryList()->toArray();
                $params = \json_decode($params['params'],true);

                try {
                    $sql = 'SELECT json FROM  disciplines 
                            WHERE (profile,special,entrance_year,name) = (:profile,:special,:entrance_year,:name) ';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':profile', $params['profile'], PDO::PARAM_STR);
                    $stmt->bindParam(':special', $params['special'], PDO::PARAM_STR);
                    $stmt->bindParam(':entrance_year', $params['year'], PDO::PARAM_STR);
                    $stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
                    $stmt->execute();
                    $res = $stmt->fetchColumn();
                    $staticData = \json_decode($res, true);
                } catch (\PDOException $e) {
                    echo $e->getMessage();
                }

                try {
                    $sql = 'SELECT json FROM  disciplines_history
                            WHERE (profile,special,entrance_year,name) = (:profile,:special,:entrance_year,:name) 
                            ORDER  BY last_change DESC NULLS 
                            LAST LIMIT 1 ';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':profile', $params['profile'], PDO::PARAM_STR);
                    $stmt->bindParam(':special', $params['special'], PDO::PARAM_STR);
                    $stmt->bindParam(':entrance_year', $params['year'], PDO::PARAM_STR);
                    $stmt->bindParam(':name', $params['name'], PDO::PARAM_STR);
                    $stmt->execute();
                    $res = $stmt->fetchColumn();
                    $managedData = \json_decode($res, true);
                } catch (\PDOException $e) {
                    echo $e->getMessage();
                }

                $data['static'] = $staticData;
                $data['managed'] = $managedData;

                $RPD = new RPDManager($data);

                die(\json_encode($RPD->data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
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
                $pdo = Postgres::getInstance()->connect('pgsql:host=172.16.10.59;port=5432;dbname=Syllabuses_test;', 'umd-web', 'klopik463');
                $params = $request['params'];

                try {
                    $sql = 'INSERT INTO disciplines_history as dh (profile,special,entrance_year,name,last_change,json)
                            VALUES (:profile,:special,:entrance_year,:name, current_timestamp,:data)
                            ON CONFLICT (profile,special,entrance_year,name)
                            DO UPDATE
                            SET json = :data, last_change = current_timestamp
                            WHERE dh.profile = :profile
                                AND dh.special = :special
                                AND dh.entrance_year = :entrance_year
                                AND dh.name = :name';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':profile', $params['profile'], PDO::PARAM_STR);
                    $stmt->bindParam(':special', $params['special'], PDO::PARAM_STR);
                    $stmt->bindParam(':entrance_year', $params['year'], PDO::PARAM_STR);
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
