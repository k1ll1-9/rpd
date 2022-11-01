<?php

declare(strict_types=1);

namespace VAVT\UP;

class DataManager
{
    public static function getUnitTitles(&$data)
    {
        $data['static']['unitTitles'] = [
            1 => [
                'title' => 'Цели и задачи освоения дисциплины',
                'code' => 'disciplineTarget',
                'subUnits' => [
                    1 => [
                        'title' => 'Цель освоения дисциплины',
                        'code' => 'target'
                    ],
                    2 => [
                        'title' => 'Задачи освоения дисциплины',
                        'code' => 'task'
                    ]
                ]
            ],
            2 => [
                'title' => 'Место дисциплины в структуре ОПОП',
                'code' => 'disciplinePlace'
            ],
            3 => [
                'title' => 'Компетенции обучающихся, формируемые в результате освоения дисциплины',
                'code' => 'competencies'
            ],
            4 => [
                'title' => 'Структура дисциплины',
                'code' => 'disciplineStructure'
            ],
            5 => [
                'title' => 'Содержание дисциплины',
                'code' => 'disciplineModules',
                'subUnits' => [
                    1 => [
                        'title' => 'Темы и их аннотации',
                        'code' => 'modulesThemes'
                    ],
                    2 => [
                        'title' =>
                            'Планы семинарских / практических занятий',
                        'code' => 'modulesSeminars'
                    ],
                    3 => [
                        'title' =>
                            'Программа самостоятельной работы студентов',
                        'code' => 'modulesSRS'
                    ],
                ]
            ],
            6 => [
                'title' => 'Образовательные технологии',
                'code' => 'educationTechnologies'
            ],
            7 => [
                'title' => 'Аннотация рабочей программы дисциплины',
                'code' => 'annotation'
            ],
            8 => [
                'title' => 'Учебно-методическое и информационное обеспечение дисциплины',
                'code' => 'informationalResources'
            ],
            9 => [
                'title' => 'Оценочные материалы',
                'code' => 'gradeResources'
            ]
        ];
    }

    public static function checkCompetencies(&$data)
    {
        //добавляем новые
        foreach ($data['static']['competencies'] as $compID => $competency) {

            if (!isset($data['managed']['competencies'][$compID])) {
                $data['managed']['competencies'][$compID] = $competency;
                $data['managed']['competencies'][$compID]['nextLvl'] = [];
            }

            $data['managed']['competencies'][$compID]['name'] = $competency['name'];
            $data['managed']['competencies'][$compID]['rowOrder'] = $competency['rowOrder'];

            foreach ($competency['nextLvl'] as $indID => $indicator) {

                if (!isset($data['managed']['competencies'][$compID]['nextLvl'][$indID])) {
                    $data['managed']['competencies'][$compID]['nextLvl'][$indID] = $indicator;
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

                $data['managed']['competencies'][$compID]['nextLvl'][$indID]['name'] = $indicator['name'];
                $data['managed']['competencies'][$compID]['nextLvl'][$indID]['rowOrder'] = $indicator['rowOrder'];
            }
        }
        //скрываем старые
        foreach ($data['managed']['competencies'] as $compID => $competency) {

            if (!isset($data['static']['competencies'][$compID])) {
                unset($data['managed']['competencies'][$compID]);
                continue;
            }

            foreach ($competency['nextLvl'] as $indID => $indicator) {
                if (!isset($data['static']['competencies'][$compID]['nextLvl'][$indID])) {
                    unset($data['managed']['competencies'][$compID]['nextLvl'][$indID]);
                }
            }
        }


        foreach ($data['managed']['competencies'] as &$competency) {
            \ksort($competency['nextLvl']);
        }

        \uasort($data['managed']['competencies'], fn($a, $b) => $a['rowOrder'] <=> $b['rowOrder']);
    }

    public static function checkCompetenciesBeforeSave(&$newData, $oldData)
    {
        foreach ($oldData['competencies'] as $compID => $competency) {

            if (!isset($newData['competencies'][$compID])) {
                $newData['competencies'][$compID] = $competency;
                continue;
            }

            foreach ($competency['nextLvl'] as $indID => $indicator) {

                if (!isset($newData['competencies'][$compID]['nextLvl'][$indID])) {
                    $newData['competencies'][$compID]['nextLvl'][$indID] = $indicator;
                }

            }
        }
    }

    public static function checkInformResources(&$data)
    {

        if (null !== $data['managed']['informationalResources']) {
            //добавляем новые
            foreach ($data['static']['informationalResources'] as $key => $item) {
                if (!isset($data['managed']['informationalResources'][$key])) {
                    $data['managed']['informationalResources'][$key] = $item;
                }
            }
            //скрываем неакутальные и актуализируем остальные
            foreach ($data['managed']['informationalResources'] as $key => $item) {
                if (!isset($data['static']['informationalResources'][$key])) {
                    unset($data['managed']['informationalResources'][$key]);
                } else {
                    $data['managed']['informationalResources'][$key]['order'] = $data['static']['informationalResources'][$key]['order'];
                    $data['managed']['informationalResources'][$key]['name'] = $data['static']['informationalResources'][$key]['name'];
                }
            }
        }

    }

    public static function checkInformResourcesBeforeSave(&$newData, $oldData)
    {
        foreach ($oldData['informationalResources'] as $key => $item) {
            if (!isset($newData['informationalResources'][$key])) {
                $newData['informationalResources'][$key] = $item;
            }
        }
    }

    public static function getControlShortNames(&$data)
    {
        foreach ($data['static']['disciplineValue']['control']['semesters'] as $item) {
            switch ($item['controlName']) {
                //case ''
            }

        }
    }
}
