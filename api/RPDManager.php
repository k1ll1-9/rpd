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
                    'seminars' => null
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
