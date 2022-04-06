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

    public static function getInformResources(&$data)
    {
        if (null === $data['managed']['informationalResources']) {
            $data['managed']['informationalResources'] = [
                0 => [
                    'value' => ''
                ]
            ];
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
        RPDManager::getInformResources($data);
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
            $res = $pdo->query('SELECT profile,special,entrance_year,syllabus_year,qualification FROM syllabuses')->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return $res;
    }

    public static function getSyllabusFiles($params)
    {
        $pdo = Postgres::getInstance()->connect('pgsql:host='.DB_HOST.';port=5432;dbname='.DB_NAME.';', DB_USER, DB_PASSWORD);

        try {
            $sql = 'SELECT array_to_json(pdf_f) as pdf_f,
                           array_to_json(competencies_f) as competencies_f,
                           array_to_json(schedule_f) as schedule_f,
                           array_to_json(practice_f) as practice_f,
                           array_to_json(oop_f) as oop_f,
                           array_to_json(methodical_f) as methodical_f,
                           array_to_json(distant_f) as distant_f
                    FROM  syllabuses 
                    WHERE (profile,special,entrance_year) = (:profile,:special,:entrance_year) ';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':profile', $params['profile'], PDO::PARAM_STR);
            $stmt->bindParam(':special', $params['special'], PDO::PARAM_STR);
            $stmt->bindParam(':entrance_year', $params['year'], PDO::PARAM_STR);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        $res = [
            [
                'colName' => 'pdf_f',
                'arFiles' => self::getArFiles($res['pdf_f']),
                'title' => 'Загрузить PDF'
            ],
            [
                'colName' => 'competencies_f',
                'arFiles' => self::getArFiles($res['competencies_f']),
                'title' => 'Загрузить Компетенцию'
            ],
            [
                'colName' => 'schedule_f',
                'arFiles' => self::getArFiles($res['schedule_f']),
                'title' => 'Загрузить График'
            ],
            [
                'colName' => 'gia_f',
                'arFiles' => self::getArFiles($res['gia_f']),
                'title' => 'Загрузить График'
            ],
            [
                'colName' => 'practice_f',
                'arFiles' => self::getArFiles($res['practice_f']),
                'title' => 'Загрузить Практику'
            ],
            [
                'colName' => 'oop_f',
                'arFiles' => self::getArFiles($res['oop_f']),
                'title' => 'Загрузить ООП'
            ],
            [
                'colName' => 'methodical_f',
                'arFiles' => self::getArFiles($res['methodical_f']),
                'title' => 'Загрузить Методический Документ'
            ],
            [
                'colName' => 'distant_f',
                'arFiles' => self::getArFiles($res['distant_f']),
                'title' => 'Загрузить Дистант и ЭО'
            ]
        ];

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

        $res = CUser::GetByID($user['ID'])->fetch();
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

        if (CSite::InGroup([1])) {
            $user['role'] = 'admin';
        } else {
            $user['role'] = 'user';
        }

        return $user;
    }

    public static function getArFiles(?string $JSONpath)
    {
        if ($JSONpath === null) {
            return null;
        }

        $arFiles = [];

        $arPath = \json_decode($JSONpath, true);

        foreach ($arPath as $key => $path) {
            $exp = \explode('/', $path);
            $arFiles[$key]['name'] = $exp[\count($exp) - 1];
            $arFiles[$key]['path'] = $path;
        }

        return $arFiles;
    }


}
