<?php
declare(strict_types=1);

namespace VAVT\UP;

require_once(__DIR__ . "/../../config.php");
require_once(__DIR__ . "/../../vendor/autoload.php");

use VAVT\Services\Postgres;
use Bitrix\Main\Web\HttpClient;

class RPDManager
{
    public static function getRPDFromDB($params)
    {
        $pdo = Postgres::getInstance()->connect('pgsql:host=' . DB_HOST . ';port=5432;dbname=' . DB_NAME . ';', DB_USER, DB_PASSWORD);

        try {
            $sql = 'SELECT json,status,valid,approval FROM  disciplines 
                            WHERE (syllabus_id,code,kafedra) = (:syllabus_id,:code,:kafedra)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':syllabus_id', $params['syllabusID'], \PDO::PARAM_STR);
            $stmt->bindParam(':code', $params['code'], \PDO::PARAM_STR);
            $stmt->bindParam(':kafedra', $params['kafedra'], \PDO::PARAM_STR);
            $stmt->execute();
            $res = $stmt->fetch(\PDO::FETCH_ASSOC);
            if ($res) {
                $data['static'] = \json_decode($res['json'], true);
                $data['status'] = $res['status'];
                $data['locked'] = $res['approval'] === 'inProcess';
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        $data['managed'] = self::getRPDHistory($params);

        DataManager::checkCompetencies($data);
        DataManager::checkInformResources($data);
        DataManager::getUnitTitles($data);
        DataManager::getControlShortNames($data);
        $data['version'] = '2022041501';

        return $data;
    }

    public static function getRPDHistory($params)
    {
        $pdo = Postgres::getInstance()->connect('pgsql:host=' . DB_HOST . ';port=5432;dbname=' . DB_NAME . ';', DB_USER, DB_PASSWORD);

        try {
            $sql = 'SELECT json FROM  disciplines_history
                            WHERE (syllabus_id,code,kafedra) = (:syllabus_id,:code,:kafedra) 
                            ORDER  BY last_change DESC NULLS 
                            LAST LIMIT 1 ';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':syllabus_id', $params['syllabusID'], \PDO::PARAM_STR);
            $stmt->bindParam(':code', $params['code'], \PDO::PARAM_STR);
            $stmt->bindParam(':kafedra', $params['kafedra'], \PDO::PARAM_STR);
            $stmt->execute();
            $res = $stmt->fetchColumn();

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        if ($res) {
            $res = \json_decode($res, true);
        }

        return $res;

    }


    public static function getRPDList($params)
    {
        $pdo = Postgres::getInstance()->connect('pgsql:host=' . DB_HOST . ';port=5432;dbname=' . DB_NAME . ';', DB_USER, DB_PASSWORD);

        try {
            $sql = "SELECT json,actual,status,valid,approval,kafedra,syllabus_id,rpd_f FROM  disciplines 
                            WHERE syllabus_id = :syllabus_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':syllabus_id', $params['id'], \PDO::PARAM_STR);
            $stmt->execute();
            $res = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        foreach ($res as $item) {
            $item['approvedLink'] = ($item['pdf_f']) ? Cipher::encryptSSL($item['pdf_f']) : null;

        }

        \usort($res, function ($d1, $d2) {

            $a = \json_decode($d1['json'], true)['disciplineIndex'];
            $b = \json_decode($d2['json'], true)['disciplineIndex'];
            $exp1 = \explode('.', $a);
            $exp2 = \explode('.', $b);
            $aBlock = $exp1[0];
            $aType = ($exp1[1] === 'О') ? 0 : 1;
            $bBlock = $exp2[0];
            $bType = ($exp2[1] === 'О') ? 0 : 1;
            $DV1 = ($exp1[2] !== 'ДВ') ? 0 : 1;
            $DV2 = ($exp2[2] !== 'ДВ') ? 0 : 1;
            $actual1 = ($d1['actual']) ? 0 : 1;
            $actual2 = ($d2['actual']) ? 0 : 1;


            if (\strcoll($aBlock, $bBlock) > 0) {
                $blockCmp = 1;
            } else if (\strcoll($aBlock, $bBlock) < 0) {
                $blockCmp = -1;
            } else {
                $blockCmp = 0;
            }

            if (\count($exp1) === \count($exp2)) {
                if (\count($exp1) === 3) {
                    $numCmp1 = $exp1[2] <=> $exp2[2];
                } else if (\count($exp1) === 2) {
                    $numCmp3 = $exp1[1] <=> $exp2[1];
                } else if (\count($exp1) === 4) {
                    $numCmp1 = $exp1[2] <=> $exp2[2];
                    $numCmp2 = $exp1[3] <=> $exp2[3];
                } else if (\count($exp1) === 5) {
                    $numCmp1 = $exp1[3] <=> $exp2[3];
                    $numCmp2 = $exp1[4] <=> $exp2[4];
                }
            }

            if (\count($exp1) === 2 || \count($exp2) === 2) {
                $numCmp3 = $exp1[1] <=> $exp2[1];
                $numCmp1 = 1;
                $numCmp2 = 1;
            }

            return
                ($actual1 <=> $actual2) * 1000000 +
                $blockCmp * 100000 +
                ($aType <=> $bType) * 10000 +
                ($DV1 <=> $DV2) * 1000 +
                $numCmp3 * 100 +
                $numCmp1 * 10 +
                $numCmp2;
        });


        return $res;
    }

    public static function getSyllabusesList()
    {
        try {
            $pdo = Postgres::getInstance()->connect('pgsql:host=' . DB_HOST . ';port=5432;dbname=' . DB_NAME . ';', DB_USER, DB_PASSWORD);
            $sql = 'SELECT profile,special,entrance_year,syllabus_year,qualification,education_form,id 
                           FROM syllabuses
                           WHERE actual = true
                           ORDER BY qualification ASC,
                                    education_form ASC,
                                    special ASC,
                                    profile ASC';
            $res = $pdo->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return $res;
    }

    public static function getSyllabusFiles($params)
    {
        $pdo = Postgres::getInstance()->connect('pgsql:host=' . DB_HOST . ';port=5432;dbname=' . DB_NAME . ';', DB_USER, DB_PASSWORD);

        try {
            $sql = 'SELECT array_to_json(pdf_f) as pdf_f,
                           array_to_json(competencies_f) as competencies_f,
                           array_to_json(schedule_f) as schedule_f,
                           array_to_json(practice_f) as practice_f,
                           array_to_json(oop_f) as oop_f,
                           array_to_json(methodical_f) as methodical_f,
                           array_to_json(distant_f) as distant_f,
                           array_to_json(gia_f) as gia_f
                    FROM  syllabuses 
                    WHERE id = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $params['id'], \PDO::PARAM_STR);
            $stmt->execute();
            $res = $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        /**собираем массив данных по файлам:
         * - colName - название поля в postgres
         * - arFiles - массив описания файлов в файловой системе
         * - title - название в родительном падеже для лэйбла на кнопке вида 'Загрузить/Добавить #title#'
         **/

        $res = [
            [
                'colName' => 'pdf_f',
                'arFiles' => self::getArFiles($res['pdf_f']),
                'title' => 'Учебный план'
            ],
            [
                'colName' => 'competencies_f',
                'arFiles' => self::getArFiles($res['competencies_f']),
                'title' => 'Компетенцию'
            ],
            [
                'colName' => 'schedule_f',
                'arFiles' => self::getArFiles($res['schedule_f']),
                'title' => 'График'
            ],
            [
                'colName' => 'gia_f',
                'arFiles' => self::getArFiles($res['gia_f']),
                'title' => 'ГИА'
            ],
            [
                'colName' => 'practice_f',
                'arFiles' => self::getArFiles($res['practice_f']),
                'title' => 'Практику'
            ],
            [
                'colName' => 'oop_f',
                'arFiles' => self::getArFiles($res['oop_f']),
                'title' => 'ООП'
            ],
            [
                'colName' => 'methodical_f',
                'arFiles' => self::getArFiles($res['methodical_f']),
                'title' => 'Методический Документ'
            ],
            [
                'colName' => 'distant_f',
                'arFiles' => self::getArFiles($res['distant_f']),
                'title' => 'Дистант и ЭО'
            ]
        ];

        return $res;
    }

    public static function uploadSyllabusFile($params, $file)
    {
        //если загружается ЭЦП, проверяем есть ли соответсвующие ей документы
        if (\strpos( $file['name'],'.sig')) {
            $path = '/mnt/synology_nfs/syllabuses/' . \join('/', $params) . '/' . \str_replace('.sig', '', $file['name']);
            try {
                $pdo = Postgres::getInstance()->connect('pgsql:host=' . DB_HOST . ';port=5432;dbname=' . DB_NAME . ';', DB_USER, DB_PASSWORD);
                $sql = "SELECT {$params['colName']} FROM syllabuses 
                            WHERE id = :id
                                AND :path = ANY({$params['colName']})";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $params['id'], \PDO::PARAM_STR);
                $stmt->bindParam(':path', $path, \PDO::PARAM_STR);
                $stmt->execute();
                $result = $stmt->fetchColumn();
            } catch (\PDOException $e) {
                $result = $e->getMessage();
            }

            if ($result === false) {
                return [
                    'error' => 'WS'
                ];
            }
        }

        $fp = '/mnt/synology_nfs/syllabuses/' . \join('/', $params);
        \mkdir($fp, 0775, true);
        $fn = '/' . $file['name'];
        $path = $fp . $fn;
        \move_uploaded_file($file['tmp_name'], $path);

        try {
            $pdo = Postgres::getInstance()->connect('pgsql:host=' . DB_HOST . ';port=5432;dbname=' . DB_NAME . ';', DB_USER, DB_PASSWORD);
            $sql = "UPDATE syllabuses 
                            SET {$params['colName']} = array_append({$params['colName']}, :path)
                            WHERE id = :id
                                AND (:path <> ALL ({$params['colName']}) OR {$params['colName']} IS NULL)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $params['id'], \PDO::PARAM_STR);
            $stmt->bindParam(':path', $path, \PDO::PARAM_STR);
            $result = $stmt->execute();
        } catch (\PDOException $e) {
            $result = $e->getMessage();
        }

        if ($result === true) {
            $res = [
                'name' => $file['name'],
                'path' => Cipher::encryptSSL($path)
            ];
        } else {
            $res = [
                'error' => $result
            ];
        }

        return $res;
    }

    public static function deleteSyllabusFile($params)
    {

        $path = Cipher::decryptSSL($params['link']);

        try {
            $pdo = Postgres::getInstance()->connect('pgsql:host=' . DB_HOST . ';port=5432;dbname=' . DB_NAME . ';', DB_USER, DB_PASSWORD);
            $sql = "UPDATE syllabuses 
                            SET {$params['colName']} = array_remove({$params['colName']},:path)
                            WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $params['id'], \PDO::PARAM_STR);
            $stmt->bindParam(':path',$path, \PDO::PARAM_STR);
            $result = $stmt->execute();
        } catch (\PDOException $e) {
            return ['error' => $e->getMessage()];
        }

        if ($result === true) {
            $result = \unlink($path);
        }

        return $result ? ['success' => true] : ['error' => 'file system error'];
    }

    public static function setRPDData($request)
    {
        $pdo = Postgres::getInstance()->connect('pgsql:host=' . DB_HOST . ';port=5432;dbname=' . DB_NAME . ';', DB_USER, DB_PASSWORD);
        $params = $request['params'];

        $oldData = self::getRPDHistory($params);

        if ($oldData) {
            DataManager::checkInformResourcesBeforeSave($request['data'], $oldData);
            DataManager::checkCompetenciesBeforeSave($request['data'], $oldData);
        }

        $data = \json_encode($request['data'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

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
            $stmt->bindParam(':syllabus_id', $params['syllabusID'], \PDO::PARAM_STR);
            $stmt->bindParam(':code', $params['code'], \PDO::PARAM_STR);
            $stmt->bindParam(':kafedra', $params['kafedra'], \PDO::PARAM_STR);
            $stmt->bindParam(':data', $data, \PDO::PARAM_STR);
            if ($stmt->execute()) {
                if (isset($request['status'])) {
                    self::setStatus('status', $request['status'], $request['params']);
                }
                $res = ['success' => true];
            }
        } catch (\PDOException $e) {
            $res = ['error' => $e->getMessage()];
        }


        return $res;
    }

    public static function getUserInfo()
    {
        global $USER;
        $user['ID'] = $USER->GetID();

        $res = \CUser::GetByID($user['ID'])->fetch();
        $user['uniID'] = $res['UF_VAVT1CUNIID'];

        $res = \Bitrix\Iblock\SectionTable::getList(
            [
                'filter' => [
                    'ACTIVE' => 'Y',
                    'ID' => $res['UF_DEPARTMENT']
                ],
                'select' => ['NAME']
            ]
        )->fetchAll();

        $res = \array_map(function ($el) {
            return $el['NAME'];
        }, $res);

        $user['departmentString'] = \join('', $res);

        if (\CSite::InGroup([1])) {
            $user['role'] = 'admin';
        } else if (\CSite::InGroup([85])) {
            $user['role'] = 'editor';
        } else {
            $user['role'] = 'user';
        }


        return $user;
    }

    public static function getArFiles(?string $JSONpath, bool $ecnryptLinks = true)
    {
        if ($JSONpath === null) {
            return null;
        }

        $arFiles = [];

        $arPath = \json_decode($JSONpath, true);

        foreach ($arPath as $key => $path) {
            $exp = \explode('/', $path);
            $arFiles[$key]['name'] = $exp[\count($exp) - 1];
            $arFiles[$key]['path'] = $ecnryptLinks ? Cipher::encryptSSL($path) : $path;
        }

        return $arFiles;
    }

    public static function setStatus(string $statusName, ?string $status, array $params)
    {
        try {
            $pdo = Postgres::getInstance()->connect('pgsql:host=' . DB_HOST . ';port=5432;dbname=' . DB_NAME . ';', DB_USER, DB_PASSWORD);
            $sql = "UPDATE disciplines
                            SET {$statusName} = :status
                            WHERE  syllabus_id = :syllabus_id
                                AND code = :code
                                AND kafedra = :kafedra";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':syllabus_id', $params['syllabusID'], \PDO::PARAM_STR);
            $stmt->bindParam(':code', $params['code'], \PDO::PARAM_STR);
            $stmt->bindParam(':kafedra', $params['kafedra'], \PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, \PDO::PARAM_STR);
            if ($stmt->execute()) {
                $res = ['success' => true];
            }
        } catch (\PDOException $e) {
            $res = ['error' => $e->getMessage()];
        }

        return $res;
    }

    public static function deleteSyllabus($ID)
    {
        try {
            $pdo = Postgres::getInstance()->connect('pgsql:host=' . DB_HOST . ';port=5432;dbname=' . DB_NAME . ';', DB_USER, DB_PASSWORD);
            $sql = 'UPDATE syllabuses SET actual = false WHERE id = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $ID, \PDO::PARAM_STR);
            $res = $stmt->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        try {
            $pdo = Postgres::getInstance()->connect('pgsql:host=' . DB_HOST . ';port=5432;dbname=' . DB_NAME . ';', DB_USER, DB_PASSWORD);
            $sql = 'UPDATE disciplines SET actual = false WHERE syllabus_id = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $ID, \PDO::PARAM_STR);
            $res = $stmt->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        return ['success' => true];
    }

    public static function importRPD($params, $data)
    {
        $pdo = Postgres::getInstance()->connect('pgsql:host=' . DB_HOST . ';port=5432;dbname=' . DB_NAME . ';', DB_USER, DB_PASSWORD);
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
            $stmt->bindParam(':syllabus_id', $params['syllabusID'], \PDO::PARAM_STR);
            $stmt->bindParam(':code', $params['code'], \PDO::PARAM_STR);
            $stmt->bindParam(':kafedra', $params['kafedra'], \PDO::PARAM_STR);
            $stmt->bindParam(':data', \json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), \PDO::PARAM_STR);
            if ($stmt->execute()) {
                self::setStatus('status', 'progress', $params);
                $res = ['success' => true];
            }
        } catch (\PDOException $e) {
            $res = ['error' => $e->getMessage()];
        }

        return $res;
    }

}
