<?php
declare(strict_types=1);

namespace VAVT\UP;

class UploadManager
{

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
        $this->data['semesters'] = \array_keys($this->data['disciplineStructure']);
        $this->data['semestersCount'] = \count($this->data['semesters']);
        self::getDisciplineValue();
        self::getCompetencies();
        self::getDisciplineStructure();
        self::getInformResources();
    }

    public function getDisciplineValue()
    {

        $semesters = \array_fill_keys(\array_keys($this->data['disciplineStructure']), []);

        $disciplineValue = [
            'classroom' => [
                'label' => [
                    'value' => 'Аудиторные занятия (всего)',
                    'strong' => true
                ],
                'semesters' => $semesters,
                'total' => 0
            ],
            'lectures' => [
                'label' => [
                    'value' => 'Лекции',
                    'strong' => false
                ],
                'semesters' => $semesters,
                'total' => 0
            ],
            'practice' => [
                'label' => [
                    'value' => 'Семинарские и практические занятия',
                    'strong' => false
                ],
                'semesters' => $semesters,
                'total' => 0
            ],
            'SRS' => [
                'label' => [
                    'value' => 'Самостоятельная работа (всего)',
                    'strong' => true
                ],
                'semesters' => $semesters,
                'total' => 0
            ],
            'overall' => [
                'label' => [
                    'value' => 'Общая трудоемкость, час.',
                    'strong' => true
                ],
                'semesters' => $semesters,
                'total' => 0
            ],
            'control' => [
                'label' => [
                    'value' => 'Вид промежуточной аттестации',
                    'strong' => true
                ],
                'sum' => 0,
                'semesters' => $semesters,
                'total' => 0
            ],
            'controlOverall' => [
                'label' => [
                    'value' => 'Общая трудоемкость, зач. ед.',
                    'strong' => true
                ],
                'semesters' => $semesters,
                'total' => 0
            ],
        ];

        foreach ($this->data['disciplineStructure'] as $semester => $loadGroup) {
            foreach ($loadGroup as $type => $load) {
                if ($type === 'load') {
                    foreach ($load as $item) {
                        switch ($item['loadName']) {
                            case 'Практические':
                                $disciplineValue['practice']['semesters'][$semester]['quantity'] = $item['quantity'];
                                $disciplineValue['practice']['total'] += $item['quantity'];
                                break;
                            case 'СРС':
                                $disciplineValue['SRS']['semesters'][$semester]['quantity'] = $item['quantity'];
                                $disciplineValue['SRS']['total'] += $item['quantity'];
                                break;
                            case 'Лекции':
                                $disciplineValue['lectures']['semesters'][$semester]['quantity'] += $item['quantity'];
                                $disciplineValue['lectures']['total'] += $item['quantity'];
                                break;
                        }
                        if ($item['classroom'] === 'Аудиторная') {
                            $disciplineValue['classroom']['semesters'][$semester]['quantity'] += $item['quantity'];
                            $disciplineValue['classroom']['total'] += $item['quantity'];
                        }
                        $disciplineValue['overall']['semesters'][$semester]['quantity'] += $item['quantity'];
                        $disciplineValue['overall']['total'] += $item['quantity'];
                    }
                } elseif ($type === 'control') {
                    foreach ($load as $item) {
                        if ($item["loadName"] === 'Текущий контроль успеваемости') {
                            continue;
                        }
                        $disciplineValue['controlOverall']['semesters'][$semester]['quantity'] = $item['ZET'];
                        $disciplineValue['control']['semesters'][$semester]['controlName'] = $item['loadName'];
                        $disciplineValue['controlOverall']['total'] += $item['ZET'];
                    }
                }
            }
        }

        $this->data['disciplineValue'] = $disciplineValue;

    }

    public function getDisciplineStructure()
    {
        $this->data['disciplineStructure'] = [
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

    public function getCompetencies()
    {

        $competencies = [];


        foreach ($this->data['competencies'] as $competency) {

            $compID = $competency['competenceCipher'];

            if (!isset($data['competencies'][$compID])) {
                $competencies[$compID] = $competency;
                $competencies[$compID]['nextLvl'] = [];
            }

            foreach ($competency['nextLvl'] as $indicator) {

                $indID = $indicator['competenceCipher'];

                if (!isset($competencies[$compID]['nextLvl'][$indID])) {
                    $competencies[$compID]['nextLvl'][$indID] = $indicator;
                }

                if (!isset($competencies[$compID]['nextLvl'][$indID]['results'])) {

                    $competencies[$compID]['nextLvl'][$indID]['results'] = [
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

        foreach ($competencies as &$competency) {
            \ksort($competency['nextLvl']);
        }

        $this->data['competencies'] = $competencies;
    }

    //ключи массива имеют значение!!!
    public function getInformResources()
    {

        $this->data['informationalResources'] = [
            1 => [
                'order' => 1,
                'name' => 'Основная литература',
                'data' => [
                    0 => [
                        'value' => ''
                    ]
                ]
            ],
            2 => [
                'order' => 2,
                'name' => 'Дополнительная литература',
                'data' => [
                    0 => [
                        'value' => ''
                    ]
                ]
            ],
            3 => [
                'order' => 3,
                'name' => 'Информационные справочные системы и профессиональные базы данных',
                'data' => [
                    0 => [
                        'value' => ''
                    ]
                ]
            ],
            4 => [
                'order' => 4,
                'name' => 'Перечень программного обеспечения',
                'data' => [
                    0 => [
                        'value' => ''
                    ]
                ]
            ]
        ];

    }


}
