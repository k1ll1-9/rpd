<?php

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";

use VAVT\Main\Postgres;

require_once(__DIR__ . "/config.php");

$pdo = Postgres::getInstance()->connect('pgsql:host=' . DB_HOST . ';port=5432;dbname=' . DB_NAME . ';', DB_USER, DB_PASSWORD);

try {
    $sql = "SELECT syllabus_id,code,kafedra FROM  disciplines 
                            WHERE valid = 'needCheck' 
                            LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetch(\PDO::FETCH_ASSOC);
    if ($stmt->rowCount() === 0){
        echo 'Непроверенных РПД нет.';
        die();
    }
    if ($res) {
        LocalRedirect('/vavt-web/syllabuses/rpd?syllabusID='.$res['syllabus_id'].'&kafedra='.$res['kafedra'].'&code='.$res['code'].'&validationCycle=true');
    }
} catch (\PDOException $e) {
    echo $e->getMessage();
}
