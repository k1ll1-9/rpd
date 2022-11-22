<?php

use VAVT\Main\Cipher;
use VAVT\Services\Postgres;

if (!$_SERVER['DOCUMENT_ROOT']) {
    $_SERVER['DOCUMENT_ROOT'] = '/home/bitrix/www';
}

define('NOT_CHECK_PERMISSIONS', true);

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";
require $_SERVER["DOCUMENT_ROOT"] . "/update_external/config.php";

// импорт из Матрицы 2.0


$pdo = Postgres::getInstance()->connect('pgsql:host=' . DB_HOST . ';port=5432;dbname=' . DB_NAME . ';', DB_USER, DB_PASSWORD);

$sql = 'SELECT syllabus_id, name, code, json, rpd_f FROM disciplines';

$res = $pdo->query($sql)->fetchAll(\PDO::FETCH_ASSOC);

$ch = \curl_init();
\curl_setopt($ch, CURLOPT_URL, 'http://api01.vavt.loc/api/putdata');
\curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
\curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
\curl_setopt($ch, CURLOPT_POST, true);

foreach ($res as $disc) {

    $data = \json_decode($disc['json'], true);

    if ($disc['rpd_f'] !== null) {
        $exp = \explode('/',$disc['rpd_f']);
        $name = $exp[\count($exp) -1];

        $link = $name . '|https://lk.vavt.ru/helpers/getFile.php?fileSSL=' . Cipher::encryptSSL($disc['rpd_f']);
        $linkSign = $name . '.sig' . '|https://lk.vavt.ru/helpers/getFile.php?fileSSL=' . Cipher::encryptSSL($disc['rpd_f'] . '.sig');
    } else {
        $link = $linkSign = null;
    }

    $data = [
        "srcid" => "rpd",
        'opgid' => $disc['syllabus_id'],
        'rpdcode' => $data['disciplineIndex'],
        'upidyr' => $disc['code'],
        'rpdcnt' => $name,
        'rpdname' => $disc['name'],
        'rpdannot' => $data['annotation'],
        'meth' => $link,
        'meth_sign' => $linkSign
    ];

    $data = \http_build_query($data);
    \curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $res = \curl_exec($ch);
}


\curl_close($ch);

// импорт из Матрицы 1.0

$config['dbconn'] = "host=" . DB_HOST__OLD . " dbname=" . DB_NAME__OLD . " user=" . DB_USER__OLD . " password=" . DB_PASSWORD__OLD . " options='--client_encoding=UTF8'";
$conn = \pg_pconnect($config['dbconn']);

$stmt = "SELECT *
          FROM up
          WHERE up.id in (SELECT up from rpd)";
$res = \pg_query($conn, $stmt);
$res = \pg_fetch_all($res);

$ch = \curl_init();
\curl_setopt($ch, CURLOPT_URL, 'http://api01.vavt.loc/api/putdata');
\curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
\curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
\curl_setopt($ch, CURLOPT_POST, true);

foreach ($res as $row) {
    $stmt = "SELECT *
          FROM rpd
          WHERE {$row['id']} = up AND file IS NOT NULL";
    $resRPD = \pg_query($conn, $stmt);
    $resRPD = \pg_fetch_all($resRPD);
    foreach ($resRPD as $item) {

        $year = \mb_substr($row['year_of_entrance'], 0, 4);
        $path = UP_DIR__OLD . $row['special'] . ' Профиль ' . $row['profile'] . '/' . $year . '/' . $item['subject'] . '/data.json';
        $content = \json_decode(\file_get_contents($path), true);

        foreach ($content['annotation'] as $name => $annotation) {
            $link = $name . '|https://lk.vavt.ru/helpers/getFile.php?fileSSL=' . Cipher::encryptSSL(UP_DIR__OLD . $row['special'] . ' Профиль ' . $row['profile'] . '/' . $year . '/' . $item['subject'] . '/' . $name);
            $data = [
                "srcid" => "rpd",
                'opgid' => $row['id'],
                'rpdcode' => $item['subject_code'],
                'upidyr' => $item['id'],
                'rpdcnt' => $name,
                'rpdname' => $item['subject'],
                'rpdannot' => $annotation,
                'meth' => $link,
                'meth_sign' => null
            ];

            $data = \http_build_query($data);
            \curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $res = \curl_exec($ch);

        }
    }
}

\curl_close($ch);
