<?php

define('NOT_CHECK_PERMISSIONS', true);

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";
require_once(__DIR__ . "/../vendor/autoload.php");

use VAVT\Services\Postgres;

$pdo = Postgres::getInstance()->connect('pgsql:host=172.16.10.59;port=5432;dbname=Syllabuses;', 'umd-web', 'klopik463');

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

    if (isset($json['intermediateControl'])){

        foreach ($json['intermediateControl'] as $semester => $number) {

            foreach ($number as $type => $control) {
                if (isset($control['undefined'])) {
                    $json['intermediateControl'][$semester][$type]['criterion'] = $control['undefined'];
                    unset($json['intermediateControl'][$semester][$type]['undefined']);
                }
            }
        }

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

/*foreach ($res as $rpd) {

    try {
        $sql = "UPDATE disciplines
                SET status = 'progress'
                WHERE syllabus_id = :syllabus_id
                    AND code = :code
                    AND kafedra = :kafedra";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':syllabus_id', $rpd['syllabus_id'], \PDO::PARAM_STR);
        $stmt->bindParam(':code', $rpd['code'], \PDO::PARAM_STR);
        $stmt->bindParam(':kafedra', $rpd['kafedra'], \PDO::PARAM_STR);
        if ($stmt->execute()) {

            $res = ['success' => true];
        }
    } catch (\PDOException $e) {
        $res = ['error' => $e->getMessage()];
    }


}*/
