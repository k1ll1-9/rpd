<?php
declare(strict_types=1);

class RPD
{

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
        $this->data['static']['semesters'] = \count($this->data['static']['disciplineStructure']);
        self::getDisciplineValue();
        self::getDisciplineStructure();
        self::getCompetencies();
    }

    public function getDisciplineValue()
    {
        $semesters = \array_fill(1, ($this->data['static']['semesters']), []);

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

        foreach ($this->data['static']['disciplineStructure'] as $semester => $loadGroup) {
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
                                $disciplineValue['lectures']['semesters'][$semester]['quantity'] = $item['quantity'];
                                $disciplineValue['lectures']['total'] += $item['quantity'];
                                break;
                        }
                        if ($item['classroom'] === 'Аудиторная') {
                            $disciplineValue['classroom']['semesters'][$semester]['quantity'] = $item['quantity'];
                            $disciplineValue['classroom']['total'] += $item['quantity'];
                        }
                        $disciplineValue['overall']['semesters'][$semester]['quantity'] += $item['quantity'];
                        $disciplineValue['overall']['total'] += $item['quantity'];
                    }
                } elseif ($type === 'control') {
                    foreach ($load as $item) {
                        $disciplineValue['controlOverall']['semesters'][$semester]['quantity'] = $item['ZET'];
                        $disciplineValue['control']['semesters'][$semester]['controlName'] = $item['loadName'];
                        $disciplineValue['controlOverall']['total'] += $item['ZET'];
                    }
                }
            }
        }

        $this->data['static']['disciplineValue'] = $disciplineValue;

    }

    public function getDisciplineStructure()
    {
        if (null === $this->data['managed']['disciplineStructure']) {
            $this->data['managed']['disciplineStructure'] = [
                0 =>
                    [
                        "title" => '',
                        "semester" => $this->data['static']['semesters'],
                        "lectures" => null,
                        "practice" => null,
                        "SRS" => null,
                        "practicePrepare" => null
                    ]
            ];
        }
    }

    public function getCompetencies()
    {

        $this->data['managed']['competencies'] = $this->data['managed']['competencies'] ?? [];

        foreach ($this->data['static']['competencies'] as $compID => $competency) {

            if (!isset($this->data['managed']['competencies'][$compID])) {
                $this->data['managed']['competencies'][$compID] = $competency;
            }

            foreach ($competency['nextLvl'] as $indID => $indicator) {

                if (!isset($this->data['managed']['competencies'][$compID]['nextLvl'][$indID])) {
                    $this->data['managed']['competencies'][$compID]['nextLvl'][$indID] = $indicator;
                }

                if (!isset($this->data['managed']['competencies'][$compID]['nextLvl'][$indID]['results'])) {

                    $this->data['managed']['competencies'][$compID]['nextLvl'][$indID]['results'] = [
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
    }

}
