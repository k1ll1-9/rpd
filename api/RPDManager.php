<?php
declare(strict_types=1);

class RPDManager
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
        self::getDisciplineStructure();
        self::getCompetencies();
    }

    public function getDisciplineStructure()
    {
        if (null === $this->data['managed']['disciplineStructure']) {
            $this->data['managed']['disciplineStructure'] = [
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
                            'value' => ''
                        ]
                    ]
                ]
            ];
        }
    }

    public function getCompetencies()
    {

        $this->data['managed']['competencies'] = $this->data['managed']['competencies'] ?? [];

        foreach ($this->data['static']['competencies'] as $competency) {

            $compID = $competency['competenceCipher'];

            if (!isset($this->data['managed']['competencies'][$compID])) {
                $this->data['managed']['competencies'][$compID] = $competency;
                $this->data['managed']['competencies'][$compID]['nextLvl'] = [];
            }

            foreach ($competency['nextLvl'] as $indicator) {

                $indID = $indicator['competenceCipher'];

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

        foreach ($this->data['managed']['competencies'] as &$competency) {
            \ksort($competency['nextLvl']);
        }
    }

}
