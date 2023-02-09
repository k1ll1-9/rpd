<?php

if (!$_SERVER['DOCUMENT_ROOT']) {
    $_SERVER['DOCUMENT_ROOT'] = '/home/bitrix/www';
}

define('NOT_CHECK_PERMISSIONS', true);

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";
require $_SERVER["DOCUMENT_ROOT"] . "/update_external/config.php";

use VAVT\Main\MUP;
use VAVT\Services\Postgres;
use VAVT\Main\Cipher;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

$log = new Logger('Учебные планы');
$formatter = new LineFormatter(null, null, false, true);
$handler = new StreamHandler($_SERVER['DOCUMENT_ROOT'] . '/upload/logs/syllabuses_error.log', Logger::ERROR);
$handler->setFormatter($formatter);
$log->pushHandler($handler);
$handler = new StreamHandler($_SERVER['DOCUMENT_ROOT'] . '/upload/logs/syllabuses.log', Logger::INFO);
$handler->setFormatter($formatter);
$log->pushHandler($handler);

/*// импорт из Матрицы 2.0

$j = 0;

function getFileLink($JSON, $planLink, $getSigns = false)
{
    $arFiles = \array_filter(\json_decode($JSON, true), function ($path) use ($getSigns) {
        $ext = \mb_substr($path, -4);
        return $getSigns
            ? $ext === '.sig'
            : $ext !== '.sig';
    });

    if (empty($arFiles) && $getSigns === true) {
        return null;
    }

    if (empty($arFiles)) {
        $link = $planLink;
    } else {
        $link = '';
        $count = \count($arFiles);

        $i = 1;
        foreach ($arFiles as $file) {

            if ((($i === 1 && $count === 1) || $i === $count)) {
                $delimiter = '';
            } else {
                $delimiter = ';';
            }

            $exp = \explode('/', $file);
            $name = $exp[\count($exp) - 1];

            $link .= $name . '|https://lk.vavt.ru/helpers/getFile.php?fileSSL=' . Cipher::encryptSSL($file) . $delimiter;

        }
    }
    return $link;
}

$pdo = Postgres::getInstance()->connect('pgsql:host=' . DB_HOST . ';port=5432;dbname=' . DB_NAME . ';', DB_USER, DB_PASSWORD);

$sql = 'SELECT array_to_json(pdf_f) as pdf_f,
               array_to_json(competencies_f) as competencies_f,
               array_to_json(schedule_f) as schedule_f,
               array_to_json(gia_f) as gia_f,
               array_to_json(practice_f) as practice_f,
               array_to_json(oop_f) as oop_f,
               array_to_json(methodical_f) as methodical_f,
               array_to_json(distant_f) as distant_f,
               id,
               special_code,
               education_form,
               syllabus_year,
               qualification,
               profile,
               special
            FROM syllabuses
            ORDER BY qualification ASC,
                     education_form ASC,
                     special ASC,
                     profile ASC';

$res = $pdo->query($sql)->fetchAll(\PDO::FETCH_ASSOC);

$ch = \curl_init();
\curl_setopt($ch, CURLOPT_URL, EXTERNAL_API_ENDPOINT);
\curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
\curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
\curl_setopt($ch, CURLOPT_POST, true);

foreach ($res as $up) {

    $arPDF = \json_decode($up['pdf_f']);
    if (!empty($arPDF) && $arPDF !== null) {
        $exp = \explode('/', $arPDF[0]);
        $name = $exp[\count($exp) - 1];
        $planLink = $name . '|https://lk.vavt.ru/helpers/getFile.php?fileSSL=' . Cipher::encryptSSL($arPDF[0]);
    }


    $data = [
        "srcid" => "edu_prg_yr_2022",
        'upid' => $up['id'],
        'educode' => $up['special_code'],
        'begyear' => $up['syllabus_year'],
        'eduname' => $up['profile'],
        'edulevel' => $up['qualification'],
        'eduform' => $up['education_form'],
        'eduplan' => $planLink,
        'giatt' => getFileLink($up['gia_f'], $planLink),
        'giatt_sign' => getFileLink($up['gia_f'], $planLink, true),
        'edupr' => getFileLink($up['practice_f'], $planLink),
        'edupr_sign' => getFileLink($up['practice_f'], $planLink, true),
        'opmain' => getFileLink($up['oop_f'], $planLink),
        'opmain_sign' => getFileLink($up['oop_f'], $planLink, true),
        'eduschd' => getFileLink($up['schedule_f'], $planLink),
        'eduschd_sign' => getFileLink($up['schedule_f'], $planLink, true),
        'meth' => getFileLink($up['methodical_f'], $planLink),
        'meth_sign' => getFileLink($up['methodical_f'], $planLink, true),
        'eduel' => getFileLink($up['distant_f'], $planLink),
        'eduel_sign' => getFileLink($up['distant_f'], $planLink, true)
    ];

    $data = \http_build_query($data);
    \curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  //  $res = \curl_exec($ch);

    $responseCode = \curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($responseCode !== 200) {
            $log->error('Connection Error', [
                'error' => $responseCode,
                'rpdID' => [
                    'upID' => $res['id']
                ]
            ]);
        }

        $data = \json_decode($res,true);

        if ($data['status'] === 'Error') {
            $log->error('Error on ADB server', [
                'error' => $data['message'],
                'rpdID' => [
                    'upID' => $res['id']
                ]
            ]);
        }

    echo ++$j . PHP_EOL;
    echo $res . PHP_EOL;
    \ob_flush();
}

\curl_close($ch);*/

// импорт из Матрицы 1.0

$config['dbconn'] = "host=" . DB_HOST__OLD . " dbname=" . DB_NAME__OLD . " user=" . DB_USER__OLD . " password=" . DB_PASSWORD__OLD . " options='--client_encoding=UTF8'";
$conn = \pg_pconnect($config['dbconn']);

$stmt = "SELECT *
          FROM up
          WHERE up.id in (SELECT up from rpd)";
$res = \pg_query($conn, $stmt);
$res = \pg_fetch_all($res);
$i = 0;

$ch = \curl_init();
\curl_setopt($ch, CURLOPT_URL, EXTERNAL_API_ENDPOINT);
\curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
\curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
\curl_setopt($ch, CURLOPT_POST, true);

foreach ($res as $row) {

    $plx = UP_DIR__OLD . $row['file'];
    $plxFile = \file_get_contents($plx);
    $x = new SimpleXMLElement($plxFile);
    $namespaces = $x->getNamespaces(true);
    $xx = $x->children($namespaces["diffgr"])->children()->dsMMISDB;
    $x->Планы;
    $levelCode = (string)$x['КодФормыОбучения'];
    switch ($levelCode) {
        case '1':
            $level = 'Очная';
            break;
        case '2':
            $level = 'Заочная';
            break;
        case '3':
            $level = 'Очно-заочная';
            break;
    }

    $year = \mb_substr($row['year_of_entrance'], 0, 4);
    $exp = \explode('/', $row['pdf_file']);
    $fileName = $exp[\count($exp) - 1];
    $planLink = $fileName . '|https://lk.vavt.ru/helpers/getFile.php?fileSSL=' . Cipher::encryptSSL($config['plansDir'] . $row['pdf_file']);

    //ссылки на ГИА
    $giaPath = UP_DIR__OLD . $row['special'] . ' Профиль ' . $row['profile'] . '/' . $year . '/ГИА';
    $gias = MUP::getFilesArray($giaPath);
    if (empty($gias)) {
        $giaLink = $planLink;
    } else {
        $giaLink = '';
        $count = \count($gias);
        $delimiter = '';
        $i = 1;
        foreach ($gias as $gia) {
            if ($gia['name'] != '') {
                if ((($i === 1 && $count === 1) || $i === $count)) {
                    $delimiter = '';
                } else {
                    $delimiter = ';';
                }
                $giaLink .= $gia['name'] . '|https://lk.vavt.ru/helpers/getFile.php?fileSSL=' . Cipher::encryptSSL(\urldecode($gia['path'])) . $delimiter;
            } else {
                $giaLink = $planLink;
            }
        }
    }
    //ссылки на Практики
    $practicePath = UP_DIR__OLD . $row['special'] . ' Профиль ' . $row['profile'] . '/' . $year . '/Практика';
    $practices = MUP::getFilesArray($practicePath);

    if (empty($practices)) {
        $practiceLink = $planLink;
    } else {
        $practiceLink = '';
        $count = \count($practices);
        $delimiter = '';
        $i = 1;
        foreach ($practices as $practice) {
            if ($practice['name'] != '') {
                if ((($i === 1 && $count === 1) || $i === $count)) {
                    $delimiter = '';
                } else {
                    $delimiter = ';';
                }
                $practiceLink .= $practice['name'] . '|https://lk.vavt.ru/helpers/getFile.php?fileSSL=' . Cipher::encryptSSL(\urldecode($practice['path'])) . $delimiter;
            } else {
                $practiceLink = $planLink;
            }
            $i++;
        }
    }
    //ссылки на ООП
    $OOPPath = UP_DIR__OLD . $row['special'] . ' Профиль ' . $row['profile'] . '/' . $year . '/ООП';
    $OOPs = MUP::getFilesArray($OOPPath);

    if (empty($OOPs)) {
        $OOPLink = $planLink;
    } else {
        $OOPLink = '';
        $count = \count($OOPs);
        $delimiter = '';
        $i = 1;
        foreach ($OOPs as $OOP) {
            if ($OOP['name'] != '') {
                if ((($i === 1 && $count === 1) || $i === $count)) {
                    $delimiter = '';
                } else {
                    $delimiter = ';';
                }
                $OOPLink .= $OOP['name'] . '|https://lk.vavt.ru/helpers/getFile.php?fileSSL=' . Cipher::encryptSSL(\urldecode($OOP['path'])) . $delimiter;
            } else {
                $OOPLink = $planLink;
            }
            $i++;
        }
    }
    //ссылки на Методические документы
    $MethodicalPath = UP_DIR__OLD . $row['special'] . ' Профиль ' . $row['profile'] . '/' . $year . '/Методические документы';
    $Methodicals = MUP::getFilesArray($MethodicalPath);

    if (empty($Methodicals)) {
        $MethodicalLink = $planLink;
    } else {
        $MethodicalLink = '';
        $count = \count($Methodicals);
        $delimiter = '';
        $i = 1;
        foreach ($Methodicals as $Methodical) {
            if ($Methodical['name'] != '') {
                if ((($i === 1 && $count === 1) || $i === $count)) {
                    $delimiter = '';
                } else {
                    $delimiter = ';';
                }
                $MethodicalLink .= $Methodical['name'] . '|https://lk.vavt.ru/helpers/getFile.php?fileSSL=' . Cipher::encryptSSL(\urldecode($Methodical['path'])) . $delimiter;

                $i++;
            } else {
                $MethodicalLink = $planLink;
            }
        }
    }
    //ссылки на Дистант
    $eduelPath = UP_DIR__OLD . $row['special'] . ' Профиль ' . $row['profile'] . '/' . $year . '/Дистант';
    $eduels = MUP::getFilesArray($eduelPath);
    if (empty($eduels)) {
        $eduelLink = $OOPLink;
    } else {
        $eduelLink = '';
        $count = \count($eduels);
        $delimiter = '';
        $i = 1;
        foreach ($eduels as $eduel) {
            if ($eduel['name'] != '') {
                if ((($i === 1 && $count === 1) || $i === $count)) {
                    $delimiter = '';
                } else {
                    $delimiter = ';';
                }
                $eduelLink .= $eduel['name'] . '|https://lk.vavt.ru/helpers/getFile.php?fileSSL=' . Cipher::encryptSSL(\urldecode($eduel['path'])) . $delimiter;

                $i++;
            } else {
                $eduelLink = $OOPLink;
            }
        }
    }
    //ссылка на график
    if ($row['schedule_file'] === null) {
        $scheduleLink = $planLink;
    } else {
        $exp = \explode('/', $row['schedule_file']);
        $scheduleName = $exp[\count($exp) - 1];
        $scheduleLink = $scheduleName . '|https://lk.vavt.ru/helpers/getFile.php?fileSSL=' . Cipher::encryptSSL($config['plansDir'] . $row['schedule_file']);
    }

    $data = [
        "srcid" => "edu_prg_yr_2022",
        'upid' => $row['id'],
        'educode' => \substr($row['special'], 0, 8),
        'begyear' => (string)$row['year_of_entrance'],
        'eduname' => $row['profile'],
        'edulevel' => $row['level'],
        'eduform' => $level,
        'eduplan' => $planLink,
        'giatt' => $giaLink,
        'edupr' => $practiceLink,
        'opmain' => $OOPLink,
        'eduschd' => $scheduleLink,
        'meth' => $MethodicalLink,
        'eduel' => $eduelLink,
        'giatt_sign' => null,
        'edupr_sign' => null,
        'opmain_sign' => null,
        'eduschd_sign' => null,
        'meth_sign' => null,
        'eduel_sign' => null,
    ];

    $data = \http_build_query($data);
    \curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $res = \curl_exec($ch);

    $responseCode = \curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($responseCode !== 200) {
        $log->error('Connection Error', [
            'error' => $responseCode,
            'rpdID' => [
                'upID' => $res['id']
            ]
        ]);
    }

    $data = \json_decode($res,true);

    if ($data['status'] === 'Error') {
        $log->error('Error on ADB server', [
            'error' => $data['message'],
            'rpdID' => [
                'upID' => $res['id']
            ]
        ]);
    } else {
        $log->info('UP uploaded successfully', [
            'upID' => $res['id']
        ]);
    }

/*    echo ++$j . PHP_EOL;
    echo $res . PHP_EOL;
    \ob_flush();*/

}

\curl_close($ch);

