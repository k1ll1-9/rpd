<?php
declare(strict_types=1);

class RPDManager
{
    public static function getDisciplineValues(&$data)
    {
        $disciplineValues = [
            'classroom' => [
                'label' => [
                    'value' => 'Аудиторные занятия (всего)',
                    'strong' => true
                ],
                'sum' => 0,
                'semesters' => [],
                'total' => 0
            ],
            'lectures' => [
                'label' => [
                    'value' => 'Лекции',
                    'strong' => false
                ],
                'sum' => 0,
                'semesters' => [],
                'total' => 0
            ],
            'practice' => [
                'label' => [
                    'value' => 'Семинарские и практические занятия',
                    'strong' => false
                ],
                'sum' => 0,
                'semesters' => [],
                'total' => 0
            ],
            'SRS' => [
                'label' => [
                    'value' => 'Самостоятельная работа (всего)',
                    'strong' => false
                ],
                'sum' => 0,
                'semesters' => [],
                'total' => 0
            ],
            'control' => [
                'label' => [
                    'value' => 'Вид промежуточной аттестации',
                    'strong' => false
                ],
                'sum' => 0,
                'semesters' => [],
                'total' => 0
            ],
            'controlOverall' => [
                'label' => [
                    'value' => 'Общая трудоемкость, зач. ед.',
                    'strong' => false
                ],
                'sum' => 0,
                'semesters' => [],
                'total' => 0
            ],
            'overall' => [
                'label' => [
                    'value' => 'Общая трудоемкость, час.',
                    'strong' => false
                ],
                'sum' => 0,
                'semesters' => [],
                'total' => 0
            ],
        ];

        foreach ($data['static']['disciplineStructure'] as $semester => $item) {
            switch ($item['Вид']) {
                case 'Нагрузка':
                    switch ($item['loadName']) {
                        case 'Практические':
                            $disciplineValues['practice'][$semester]['quantity'] = $item['quantity'];
                            $disciplineValues['practice']['total'] += $item['quantity'];
                            break;
                        case 'СРС':
                            $disciplineValues['SRS'][$semester]['quantity'] = $item['quantity'];
                            $disciplineValues['SRS']['total'] += $item['quantity'];
                            break;
                        case 'Лекции':
                            $disciplineValues['lectures'][$semester]['quantity'] = $item['quantity'];
                            $disciplineValues['lectures']['total'] += $item['quantity'];
                            break;
                    }
                    if ($item['classroom'] === 'Аудиторная') {
                        $disciplineValues['classroom'][$semester]['quantity'] = $item['quantity'];
                        $disciplineValues['classroom']['total'] += $item['quantity'];
                    }

            }
        }
        echo "<pre>";
        var_dump($data['static']['disciplineStructure']);
        echo "</pre>";
        die();

    }
}
