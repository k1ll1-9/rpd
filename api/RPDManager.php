<?php
declare(strict_types=1);

use VAVT\Services\Postgres;

class RPDManager
{

    public static function getDisciplineStructure(&$data)
    {
        if (null === $data['managed']['disciplineStructure']) {
            $data['managed']['disciplineStructure'] = [
                0 => [
                    'title' => null,
                    'semester' => null,
                    'load' => null,
                    'theme' => null,
                    'seminars' => null,
                    'indicators' => null,
                    'competences' => null,
                    'currentControl' => [
                        0 => [
                            'title' => '',
                            'value' => ''
                        ]
                    ]
                ]
            ];
        }
    }

    public static function getCompetencies(&$data)
    {

        $data['managed']['competencies'] = $data['managed']['competencies'] ?? [];

        foreach ($data['static']['competencies'] as $competency) {

            $compID = $competency['competenceCipher'];

            if (!isset($data['managed']['competencies'][$compID])) {
                $data['managed']['competencies'][$compID] = $competency;
                $data['managed']['competencies'][$compID]['nextLvl'] = [];
            }

            foreach ($competency['nextLvl'] as $indicator) {

                $indID = $indicator['competenceCipher'];

                if (!isset($data['managed']['competencies'][$compID]['nextLvl'][$indID])) {
                    $data['managed']['competencies'][$compID]['nextLvl'][$indID] = $indicator;
                }

                if (!isset($data['managed']['competencies'][$compID]['nextLvl'][$indID]['results'])) {

                    $data['managed']['competencies'][$compID]['nextLvl'][$indID]['results'] = [
                        'know' => [
                            0 => [
                                'value' => ''
                            ]
                        ],
                        'able' => [
                            0 => [
                                'value' => ''
                            ]
                        ],
                        'master' => [
                            0 => [
                                'value' => ''
                            ]
                        ]
                    ];
                }
            }
        }

        foreach ($data['managed']['competencies'] as &$competency) {
            \ksort($competency['nextLvl']);
        }
    }

    public static function getRPDFromDB($params)
    {
        $pdo = Postgres::getInstance()->connect('pgsql:host='.DB_HOST.';port=5432;dbname='.DB_NAME.';', DB_USER, DB_PASSWORD);

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
            if ($res) {
                $data['static'] = \json_decode($res, true);
            }
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
            if ($res) {
                $data['managed'] = \json_decode($res, true);
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        RPDManager::getDisciplineStructure($data);
        RPDManager::getCompetencies($data);

        return $data;
    }

    public static function getRPDList($params)
    {
        $pdo = Postgres::getInstance()->connect('pgsql:host='.DB_HOST.';port=5432;dbname='.DB_NAME.';', DB_USER, DB_PASSWORD);

        try {
            $sql = 'SELECT json FROM  disciplines 
                            WHERE (profile,special,entrance_year) = (:profile,:special,:entrance_year) ';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':profile', $params['profile'], PDO::PARAM_STR);
            $stmt->bindParam(':special', $params['special'], PDO::PARAM_STR);
            $stmt->bindParam(':entrance_year', $params['year'], PDO::PARAM_STR);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return $res;
    }

    public static function getSyllabusesList()
    {
        try {
            $pdo = Postgres::getInstance()->connect('pgsql:host='.DB_HOST.';port=5432;dbname='.DB_NAME.';', DB_USER, DB_PASSWORD);
            $res = $pdo->query('SELECT * FROM syllabuses')->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return $res;
    }

    public static function setRPDData($request)
    {
        $data = \json_encode($request['data'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        $pdo = Postgres::getInstance()->connect('pgsql:host='.DB_HOST.';port=5432;dbname='.DB_NAME.';', DB_USER, DB_PASSWORD);
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
            $res = ['success' => true];

        } catch (\PDOException $e) {
            $res = ['error' => $e->getMessage()];
        }
        return $res;
    }

    public static function getUserInfo()
    {
        global $USER;
        $user['ID'] = $USER->GetID();

        $res = CUser::GetByID(13825)->fetch();
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

        $user['departmentString']  = \join('', $res);

        if (CSite::InGroup(1)){
            $user['role'] = 'admin';
        } else {
            $user['role'] = 'user';
        }

        return $user;
    }
}
