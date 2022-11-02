<?php

require_once(__DIR__ . "/../vendor/autoload.php");

use VAVT\UP\PDF;

\ini_set('display_errors', 1);
\error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

//$json = \json_decode(\file_get_contents('php://input'),true)['data'];
$json = \json_decode(\file_get_contents('mockRPD.json'), true);

$static = $json["static"];
$syllabusData = $static["syllabusData"];
$disciplineValue = $static["disciplineValue"];
$unitTitles = $static["unitTitles"];
$managed = $json["managed"];
$competencies = $managed["competencies"];
$disciplineStructure = $managed["disciplineStructure"];
$intermediateControl = $managed["intermediateControl"];

$order = [
    "lectures" => 0,
    "practice" => 1,
    "classroom" => 2,
    "SRS" => 3,
    "control" => 4,
    "overall" => 5,
    "controlOverall" => 6
];

\uksort($disciplineValue, fn($a, $b) => $order[$a] <=> $order[$b]);

$year = \date('Y', \strtotime($syllabusData["syllabusYear"]));

$modules = [];

foreach ($disciplineStructure as $key => $ds) {
    $modules[$ds['semester']][$key + 1] = $ds;
}

$sModules = [];

foreach ($disciplineStructure as $key => $ds) {
    $seminarsCount = \ceil((int)$ds['load']['seminars'] / 2);

    if ($seminarsCount > 0) {
        $sModules[$ds['semester']][$key + 1]['seminars'] = $ds['seminars'];
        $sModules[$ds['semester']][$key + 1]['title'] = $ds['title'];
        $sModules[$ds['semester']][$key + 1]['seminarsCount'] = $seminarsCount;
    }
}

$SRSModules = [];

foreach ($disciplineStructure as $key => $ds) {
    if ((isset($ds['load']['SRS']) && $ds['load']['SRS'] > 0) && !empty($ds['SRSTypes'])) {
        $SRSModules[$ds['semester']][$key + 1]['SRSTypes'] = $ds['SRSTypes'];
        $SRSModules[$ds['semester']][$key + 1]['title'] = $ds['title'];
    }
}

$html = '<style>
table{
    width: 100%!important
}
*{
    font-size: 12pt;
}
h2{
    font-size: 17pt;
}
h3{
    font-size: 15pt;
}
h4{
    font-size: 14pt;
}
p{
    text-align: justify;
    text-indent: 10px !important;
    margin: 0 !important;
    padding: 0  !important;
}
.front-page p{
text-align: center;
}
</style>';
$html .= '
<p style="text-align: center;">
        ФЕДЕРАЛЬНОЕ ГОСУДАРСТВЕННОЕ БЮДЖЕТНОЕ ОБРАЗОВАТЕЛЬНОЕ 
        <br>УЧРЕЖДЕНИЕ ВЫСШЕГО ОБРАЗОВАНИЯ
        <br>«ВСЕРОССИЙСКАЯ АКАДЕМИЯ ВНЕШНЕЙ ТОРГОВЛИ 
        <br>МИНИСТЕРСТВА ЭКОНОМИЧЕСКОГО РАЗВИТИЯ РОССИЙСКОЙ ФЕДЕРАЦИИ»
        <br>
        </p>
        <p> </p>
<!--
        <table  style=": 100%">
            <tr>
                <td>
                    &nbsp;
                </td>
                <td style="text-align: right;">
                    «Утверждаю»
                    <br>Проректор по учебной работе
                    <br>_____________Идрисова В.В.
                    <br>«___»______________2021 г.
                </td>
            </tr>
        </table>-->
        <table  style=": 100%">
            <tr>
                <td>
                    &nbsp;
                </td>
                <td style="text-align: center;">
                    <br>
                    <br>
                    <br><span style="color:#ffffff">{SP4}</span>
                    <br>
                    <br>
                </td>
            </tr>
        </table>';

//TODO перенести штампы на 2ю страницу
$discTarget = escape4PDF($managed["disciplineTarget"]['target']);
$discTask = escape4PDF($managed["disciplineTarget"]['task']);
$discPlace = escape4PDF($managed["disciplinePlace"]);

$html .= <<<HTML
<br>    
<br>    
<br>    
<br>    
<br>    
<br>    
<br>    
<div style="font-size: 13pt;text-align: center;"  class="front-page">
<p style="font-size: 14pt"><strong>Рабочая программа учебной дисциплины</strong><br></p>
<p style=" font-size: 18pt"><b>{$static["disciplineIndex"]}  {$static["name"]} </b><br></p>
<p>Код и направление подготовки - {$syllabusData["specialCode"]}  «{$syllabusData["special"]}»<br></p>
<p>Профиль – «{$syllabusData["profile"]}»<br></p>
<p>Квалификация выпускника – {$syllabusData["educationLevel"]}</p>
<p>Форма обучения – {$syllabusData["formOfTraining"]} </p>
<p>Год набора – $year г.</p>
</div>
<br pagebreak="true"/>
<span style="text-align: left">Разработчик программы: <br></span>
<span style="text-align: left"><i>{$managed['authors']['author']['FIO']}</i>, {$managed['authors']['author']['position']}</span>
<br>
<br>
<span style="text-align: left">Рецензенты: <br></span>
<span style="text-align: left"><i>{$managed['authors']['reviewer']['FIO']}</i>, {$managed['authors']['reviewer']['position']}</span>
<br pagebreak="true"/>

<h2 style="text-align: center">1. {$unitTitles[1]["title"]}  <br></h2>
<h3 style="text-align: center">1.1 {$unitTitles[1]["subUnits"][1]["title"]}</h3>
$discTarget 
<div></div>
<h3 style="text-align: center">1.2 {$unitTitles[1]["subUnits"][2]["title"]} </h3>
$discTask
<div></div>
<div></div>
<h2 style="text-align: center">2. {$unitTitles[2]["title"]}</h2>
$discPlace
<div></div>
<h2 style="text-align: center">3. {$unitTitles[3]["title"]}</h2>
<table  style=": 100%" border="1">
            <thead>
                <tr>
                    <td style="text-align: center">
                    Код и наименование компетенции
                    </td>
                    <td style="text-align: center">
                    Код(ы) и наименование(-ия) индикатора(ов) достижения компетенций
                    </td>
                    <td style="text-align: center">
                    Планируемые результаты обучения
                    </td>
                </tr>
            </thead>
            <tbody>
HTML;
$tContent = [];
$rowCount = 0;
$j = 0;
foreach ($competencies as $id => $comp) {

    $i = 0;
    $tContent[$j]['name'] = $comp['name'];
    $tContent[$j]['cipher'] = $comp['competenceCipher'];
    $tContent[$j]['indicators'] = [];

    foreach ($comp['nextLvl'] as $key => $ind) {
        $tContent[$j]['indicators'][$i]['name'] = $ind['name'];
        $tContent[$j]['indicators'][$i]['cipher'] = $ind['competenceCipher'];
        $tContent[$j]['indicators'][$i]['results'] = $ind['results'];
        $i++;
        $rowCount++;
    }
    $tContent[$j]['rowspan'] = $i;
    $j++;
}

$j = 0;
$k = 0;

for ($i = 0; $i < $rowCount; $i++) {

    $html .= '<tr>';

    if ($k === 0 || $k === $tContent[$j]["rowspan"]) {
        $html .= '<td rowspan="' . $tContent[$j]["rowspan"] . '"><b>' . $tContent[$j]["cipher"] . '</b>. ' . $tContent[$j]["name"] . '</td>';

    }

    $html .= '<td><b>' . $tContent[$j]['indicators'][$k]['cipher'] . '</b>. ' . $tContent[$j]['indicators'][$k]["name"] . '</td>';

    $know = $tContent[$j]['indicators'][$k]['results']['know'];
    $able = $tContent[$j]['indicators'][$k]['results']['able'];
    $master = $tContent[$j]['indicators'][$k]['results']['master'];

    $html .= '<td>';
    $html .= '<p><b>Знать</b>:<br>';

    foreach ($know as $key => $item) {
        $EOL = ($key !== (\count($know) - 1)) ? '<br>' : '';
        $html .= ' - ' . $item['value'] . $EOL;
    }
    $html .= '</p>';
    $html .= '<p><b>Уметь</b>:<br>';
    foreach ($able as $item) {
        $EOL = ($key !== (\count($able) - 1)) ? '<br>' : '';
        $html .= ' - ' . $item['value'] . $EOL;
    }
    $html .= '</p>';
    $html .= '<p><b>Владеть</b>:<br>';
    foreach ($master as $item) {
        $EOL = ($key !== (\count($master) - 1)) ? '<br>' : '';
        $html .= ' - ' . $item['value'] . $EOL;
    }
    $html .= '</p>';
    $html .= '</td>';
    $html .= '</tr>';

    $k++;

    if ($k === $tContent[$j]["rowspan"]) {
        $k = 0;
        $j++;
    }

}

$html .= '</tbody> </table><br>';

$html .= '<h2 style="text-align: center">4.' . $unitTitles[4]["title"] . '</h2>';

$html .= '<h3 style="text-align: center"> Объем дисциплины и виды учебной работы </h3>';

$colspan = count($static["semesters"]);
$html .= '<table  style=": 100%" border="1">
            <thead>
                <tr>
                    <th style="text-align: center" rowspan="2">
                    Вид учебной работы
                    </th>
                    <th style="text-align: center" rowspan="2">
                    Всего часов
                    </th>
                    <th style="text-align: center" colspan="' . $colspan . '">
                    Семестр 
                    </th>
                </tr>
                <tr>';
foreach ($static["semesters"] as $semester) {
    $html .= '<td style="text-align: center">' . $semester . '</td>';
}
$html .= '</tr>
            </thead>
         ';

$html .= '<tbody>';
foreach ($disciplineValue as $dv) {
    if ($dv["label"]["strong"]) {
        $strongOpen = '<strong>';
        $strongClose = '</strong>';
    } else {
        $strongOpen = '';
        $strongClose = '';
    }
    $html .= '<tr>';
    $html .= '<td style="text-align: left; vertical-align: middle;">' . $strongOpen . $dv["label"]["value"] . $strongClose . '</td>';
    $total = '-';
    if ($dv["total"] == 0) {
        $html .= '<td style="text-align: center; vertical-align: middle;">' . $strongOpen . '-' . $strongClose . '</td>';
    } else {
        $html .= '<td style="text-align: center; vertical-align: middle;">' . $strongOpen . $dv["total"] . $strongClose . '</td>';
    }
    if ($dv["label"]["value"] == "Вид промежуточной аттестации") {
        foreach ($dv["semesters"] as $semestersHour) {
            if (\is_array($semestersHour["controlName"])) {
                $semestersHour["controlName"] = \implode('-', $semestersHour["controlName"]);
            }
            $html .= '<td style="text-align: center; vertical-align: middle;">' . $strongOpen . $semestersHour["controlName"] . $strongClose . '</td>';
        }
    } else {
        foreach ($dv["semesters"] as $semestersHour) {
            $quantity = '-';
            if (\is_array($semestersHour["quantity"])) {
                $semestersHour["quantity"] = \implode('-', $semestersHour["quantity"]);
            }
            if ($semestersHour["quantity"] == 0) {
                $html .= '<td style="text-align: center; vertical-align: middle;">' . $strongOpen . '-' . $strongClose . '</td>';
            } else {
                $html .= '<td style="text-align: center; vertical-align: middle;">' . $strongOpen . $semestersHour["quantity"] . $strongClose . '</td>';
            }
        }
    }
    $html .= '</tr>';
}

$html .= <<<HTML
</tbody>
</table>

<h3 style="text-align: center"> Структура и содержание дисциплины (модуля) </h3>

<table  style=": 100%" border="1">
            <thead>
                <tr>
                    <th style="text-align: center; width:5%" rowspan="2">
                    № п/п
                    </th>
                    <th style="text-align: center; width:43%" rowspan="2">
                    Наименование раздела дисциплины
                    </th>
                    <th style="text-align: center; width:12%" rowspan="2">
                    Семестр 
                    </th>
                    <th style="text-align: center; width:24%" colspan="3">
                    Вид учебной работы <br> (в академических часах) 
                    </th>
                    <th style="text-align: center; width:15%" rowspan="2">
                    В том числе в форме практической подготовки
                    </th>
                </tr>
                <tr>
                 <th style="text-align: center" >
                    Л 
                    </th>
                 <th style="text-align: center" >
                    С/ПЗ 
                    </th>
                 <th style="text-align: center" >
                    СР 
                    </th>
                 </tr>
            </thead>
<tbody>
HTML;
$n = 0;
$themesSubCount = 1;

foreach ($disciplineStructure as $ds) {
    $n++;
    $html .= <<<HTML
    <tr>
    <td style="text-align: center; width:5%"> $n </td>
    <td style="text-align: left; width:43%"> {$ds["title"]} </td>
    <td style="text-align: center; width:12%"> {$ds["semester"]} </td>
    <td style="text-align: center; width:8%">{$ds["load"]["lectures"]}</td>
    <td style="text-align: center; width:8%"> {$ds["load"]["seminars"]} </td>
    <td style="text-align: center; width:8%"> {$ds["load"]["SRS"]} </td>
    <td style="text-align: center; width:15%">{$ds["load"]["practicePrepare"]}</td>
    </tr>
HTML;
}
$html .= <<<HTML
</tbody>
</table>
<br>
<br>

<h2 style="text-align: center">5. {$unitTitles[5]["title"]}<br></h2>
<div>
<h3 style="text-align: center">5.$themesSubCount {$unitTitles[5]["subUnits"][1]["title"]} </h3>
HTML;

foreach ($modules as $number => $semester) {
    $html .= (\count($modules) > 1) ? '<h4 style="text-align: center">Семестр ' . $number . ' </h4>' : '';
    foreach ($semester as $key => $theme) {
        $html .= '<h4 style="text-align: center">Тема ' . $key . '. ' . $theme['title'] . ' </h4>';
        $html .= escape4PDF($theme["theme"]);
    }
}
$html .= '</div>';
if (!empty($sModules)) {

    $themesSubCount++;

    $html .= '<div><h3 style="text-align: center">5.' . $themesSubCount . ' ' . $unitTitles[5]["subUnits"][2]["title"] . '</h3>';

    foreach ($sModules as $number => $semester) {

        $html .= (\count($sModules) > 1) ? '<h4 style="text-align: center">Семестр ' . $number . ' </h4>' : '';

        foreach ($semester as $key => $theme) {

            if ($theme['seminarsCount'] > 0) {

                $i = 1;

                $html .= '<h4 style="text-align: center">Тема ' . $key . '. ' . $theme['title'] . '  </h4>';

                foreach ($theme['seminars'] as $index => $seminar) {

                    $html .= '<h4 style="text-align: center">Семинар ' . $index . '</h4>';
                    $html .= escape4PDF($seminar);

                    $i++;

                    if ($i > $semester['seminarsCount']) {
                        break;
                    }
                }

            }
        }
    }
    $html .= '</div>';
}

$themesSubCount++;

$html .= <<<HTML
<div>
<h3 style="text-align: center">5.$themesSubCount {$unitTitles[5]["subUnits"][3]["title"]} </h3>

<table border="1">
            <thead>
                <tr>
                    <th style="text-align: center; width: 6%">
                    № п/п
                    </th>
                    <th style="text-align: center; width: 29%">
                    Наименование раздела дисциплины
                    </th>
                    <th style="text-align: center; width: 15%;">
                    Семестр 
                    </th>
                    <th style="text-align: center; width: 34%">
                    Вид самостоятельной работы 
                    </th>
                    <th style="text-align: center; width: 20%">
                    Трудоемкость <br> (в акад. <br> часах)
                    </th>
                </tr>
            </thead>
         
<tbody>
HTML;

$n = 0;
foreach ($disciplineStructure as $ds) {

    if ($ds['load']['SRS'] !== null) {
        $n++;
        $types = \count($ds["SRSTypes"]);

        $html .= '<tr>';
        $html .= '<td style="text-align: center; width: 6%">' . $n . '</td>';
        $html .= '<td style="text-align: center; width: 29%">' . \strip_tags($ds["title"], '') . '</td>';
        $html .= '<td style="text-align: center; width: 15%">' . $ds["semester"] . '</td>';
        $html .= '<td style="text-align: left; width: 34%">';

        foreach ($ds["SRSTypes"] as $key => $type) {
            $html .= \strip_tags($type['title']);
            if ($key !== ($types - 1)) {
                $html .= '<br><br>';
            }
        }
        $html .= '</td>';
        $html .= '<td style="text-align: center; width: 20%">' . $ds["load"]["SRS"] . '</td>';
        $html .= '</tr>';
    }
}
$html .= '</tbody></table><br>';

$html .= '<h3 style="text-align: center">Виды самостоятельной работы </h3>';


foreach ($SRSModules as $number => $semester) {

    $html .= (\count($sModules) > 1) ? '<h4 style="text-align: center">Семестр ' . $number . ' </h4>' : '';

    foreach ($semester as $key => $theme) {

        $html .= '<h4 style="text-align: center">Тема ' . $key . '. ' . $theme['title'] . '  </h4>';

        foreach ($theme['SRSTypes'] as $index => $type) {

            $html .= '<h4 style="text-align: center">' . $type['title'] . '</h4>';
            $html .= escape4PDF($type['description']);

        }
    }
}

/*foreach ($disciplineStructure as $key => $item) {

    if ($item['load']['SRS'] !== null) {
        $html .= '<h3 style="text-align: center">Тема ' . $i . '. ' . $item['title'] . '</h3>';
        foreach ($item["SRSTypes"] as $type) {
            $html .= '<h4 style="text-align: center">' . \strip_tags($type['title']) . '</h4>';
            $html .= escape4PDF($type['description']);
        }
        $i++;
    }
}*/
$html .= '</div><div></div>';
$html .= '<h2 style="text-align: center">6. ' . $unitTitles[6]["title"] . '</h2>';
$html .= '<p>' . escape4PDF($managed['educationTechnologies']) . '</p>';

/*$html .= '<h2 style="text-align: center">7. ' . $unitTitles[7]["title"] . '</h2>';
$html .= '<p>' . \strip_tags($managed['annotation'], $allowedTags) . '</p>';*/

$html .= '<div></div>';
$html .= '<h2 style="text-align: center">7. ' . $unitTitles[8]["title"] . '</h2>';

foreach ($managed['informationalResources'] as $k => $type) {
    $html .= '<div></div>';
    $html .= '<h3 style="text-align: center">7. ' . $k . '. ' . $type["name"] . '</h3>';

    foreach ($type['data'] as $key => $item) {
        $html .= '<p>' . ($key + 1) . '. ' . escape4PDF($item['value']) . '</p>';
    }
}

$html .= '<div></div><div></div>';
$html .= '<h2 style="text-align: center">8. ' . $unitTitles[9]["title"] . '</h2>';

$html .= <<<HTML

<table border="1">
    <thead>
        <tr>
            <th style="text-align: center; width: 5%">№ п/п</th>
            <th style="text-align: center; width: 30%">Наименование раздела дисциплины</th>
            <th style="text-align: center; width: 15%">Компетенция</th>
            <th style="text-align: center; width: 20%">Индикаторы достижения компетенции</th>
            <th style="text-align: center; width: 30%">Оценочные средства текущего контроля успеваемости</th>
        </tr>
    </thead>
    <tbody>
HTML;

foreach ($disciplineStructure as $key => $disc) {
    $n = $key + 1;

    $html .= '<tr>';
    $html .= '<td style="text-align: center; width: 5%">' . $n . '</td>';
    $html .= '<td style="text-align: center; width: 30%">' . $disc['title'] . '</td>';
    $html .= '<td style="text-align: center; width: 15%">' . \implode(',', $disc['competences']) . '</td>';
    $html .= '<td style="text-align: center; width: 20%">' . \implode(',', $disc['indicators']) . '</td>';
    $html .= '<td style="text-align: left; width: 30%">';

    foreach ($disc["currentControl"] as $k => $type) {
        $html .= $type['title'];
        if ($k !== (\count($disc["currentControl"]) - 1)) {
            $html .= ',<br>';
        }
    }
    $html .= '</td>';
    $html .= '</tr>';
}

$html .= <<<HTML
    </tbody>
</table>
<br>
<br>
HTML;

$html .= '<h2 style="text-align: center">9. Оценочные средства текущего контроля успеваемости</h2>';

foreach ($disciplineStructure as $key => $disc) {

    $html .= '<h4 style="text-align: center">Тема ' . ($key + 1) . '. ' . $disc['title'] . '</h4>';

    foreach ($disc["currentControl"] as $k => $type) {

        $html .= '<h4 style="text-align: center">' . \strip_tags($type['title']) . '</h4>';
        $html .= '<p>' . escape4PDF($type['value']) . '</p>';
    }
}

$html .= '<h2 style="text-align: center">10. Промежуточная аттестация</h2>';

foreach ($intermediateControl as $n => $semester) {

    $html .= '<h3 style="text-align: center">Семестр ' . $n . '</h3>';

    foreach ($semester as $controlType) {
        \uksort($controlType, fn($a, $b) => $a === 'criterion' ? 1 : -1);
        foreach ($controlType as $type => $value) {

            $title = ($type === 'criterion') ? 'Критерии оценки' : $type;
            $html .= '<h3 style="text-align: center">' . $title . '</h3>';
            $html .= '<p>' . escape4PDF($value) . '</p>';
        }
    }
}

$html .= <<<HTML
<div></div><div></div>
<h2 style="text-align: center">11. Материально-техническое обеспечение дисциплины</h2>

<p>Реализация программы предполагает наличие учебных кабинетов: </p>
<ul style="list-style-type:none">
<li>- лекционная аудитория, оборудованная видеопроекционной аппаратурой, экраном, компьютером; </li>
<li>- кабинет для практических занятий (компьютерный класс), имеющий видеопроекционную аппаратуру с возможностью подключения к ПК, экран, персональные компьютеры с возможностью подключения к информационно-телекоммуникационной сети Internet.</li>
</ul>
<div></div><div></div>
<h2 style="text-align: center">12. Обеспечение доступности освоения программы обучающимися с ограниченными возможностями здоровья</h2>

<p style="text-indent: 15px; text-align: justify">Условия организации и содержание обучения и контроля знаний обучающихся с ограниченными возможностями здоровья (далее – ОВЗ) определяются программой дисциплины, адаптированной при необходимости для обучения указанных обучающихся. </p>
<p style="text-indent: 15px; text-align: justify">Организация обучения, текущей и промежуточной аттестации студентов с ОВЗ осуществляется с учетом особенностей психофизического развития, индивидуальных возможностей и состояния здоровья таких обучающихся. Исходя из психофизического развития и состояния здоровья студентов с ОВЗ, организуются занятия совместно с другими обучающимися в общих группах, используя социально-активные и рефлексивные методы обучения создания комфортного психологического климата в студенческой группе или, при соответствующем заявлении такого обучающегося, по индивидуальной программе, которая является модифицированным вариантом основной рабочей программы дисциплины. При этом содержание программы дисциплины не изменяется. Изменяются, как правило, формы обучения и контроля знаний, образовательные технологии и учебно-методические материалы. </p>
<p style="text-indent: 15px; text-align: justify">Обучение студентов с ОВЗ также может осуществляться индивидуально и/или с применением элементов электронного обучения. Электронное обучение обеспечивает возможность коммуникаций с преподавателем, а также с другими обучаемыми посредством вебинаров (например, с использованием программы Skype), что способствует сплочению группы, направляет учебную группу на совместную работу, обсуждение, принятие группового решения. В образовательном процессе для повышения уровня восприятия и переработки учебной информации студентов с ОВЗ применяются мультимедийные и специализированные технические средства приема-передачи учебной информации в доступных формах для обучающихся с различными нарушениями, обеспечивается выпуск альтернативных форматов печатных материалов (крупный шрифт), электронных образовательных ресурсов в формах, адаптированных к ограничениям здоровья обучающихся, наличие необходимого материально-технического оснащения. Подбор и разработка учебных материалов производится преподавателем с учетом того, чтобы обучающиеся с нарушениями слуха получали информацию визуально, с нарушениями зрения – аудиально (например, с использованием программ-синтезаторов речи). </p>
<p style="text-indent: 15px; text-align: justify">Для осуществления процедур текущего контроля успеваемости и промежуточной аттестации обучающихся лиц с ОВЗ оценочные средства по дисциплине, позволяющие оценить достижение ими результатов обучения и уровень сформированности компетенций, предусмотренных учебным планом и рабочей программой дисциплины, адаптируются для лиц с ограниченными возможностями здоровья с учетом индивидуальных психофизиологических особенностей (устно, письменно на бумаге, письменно на компьютере, в форме тестирования и т.п.). При необходимости обучающимся предоставляется дополнительное время для подготовки ответа при прохождении всех видов аттестации.</p>
<p style="text-indent: 15px; text-align: justify">Особые условия предоставляются обучающиеся с ограниченными возможностями здоровья на основании заявления, содержащего сведения о необходимости создания соответствующих специальных условий.</p>
<div></div><div></div>
<h2 style="text-align: center">13. Методические указания для обучающихся по освоению дисциплины</h2>
<div></div>
<h3 style="text-align: center">13.1 Методические рекомендации по изучению дисциплины</h2>

<p style="text-indent: 15px; text-align: justify">Студентам необходимо ознакомиться: с содержанием рабочей программы дисциплины (далее – РПД), с целями и задачами дисциплины, ее связями с другими дисциплинами образовательной программы, методическими разработками по данной дисциплине, имеющимися на образовательном портале и сайте кафедры, с графиком консультаций преподавателей данной кафедры.</p>
<p style="text-indent: 15px; text-align: justify">Советы по планированию и организации времени, необходимого на изучение дисциплины. Рекомендуемое распределение времени на изучение дисциплины указано в разделе «Структура и содержание дисциплины». В целях более плодотворной работы в семестре студенты также могут ознакомиться с планом дисциплины, составленным преподавателем – как для лекционных, так и для практических занятий.</p>
<p style="text-indent: 15px; text-align: justify">«Сценарий» изучения дисциплины. «Сценарий» изучения дисциплины студентом подразумевает выполнение им следующих действий:</p>
<ul style="list-style-type:none">
<li>- ознакомление с целями и задачами дисциплины;</li>
<li>- ознакомление с требованиями к знаниям и навыкам студента;</li>
<li>- первичное ознакомление с разделами и темами дисциплины;</li>
<li>- ознакомление с распределением времени на изучение дисциплины;</li>
<li>- ознакомление со списками рекомендуемой основной и дополнительной литературы по дисциплине;</li>
<li>- углублённое ознакомление с разделами и темами дисциплины;</li>
<li>- предварительный охват на основе рекомендуемой литературы круга вопросов, актуальных для конкретного занятия; </li>
<li>- самостоятельная проработка основного круга вопросов как каждого последующего, так и каждого предыдущего занятия в свободное время между занятиями по дисциплине;</li>
<li>- присутствие и творческое участие на лекционных и семинарских / практических занятиях;</li>
<li>- выполнение требований планового текущего и итогового контроля; </li>
<li>- уточнение возникающих вопросов на консультации по дисциплине;</li>
<li>- непосредственная подготовка к экзамену по дисциплине на основе выданных преподавателем вопросов к экзамену.</li>
</ul>
<div></div>
<h3 style="text-align: center">13.2. Рекомендации по подготовке к лекционным занятиям (теоретический курс)</h2>

<p style="text-indent: 15px; text-align: justify">Студентам необходимо:</p>
<ul style="list-style-type:none">
<li>- перед каждой лекцией просматривать рабочую программу дисциплины, что позволит сэкономить время на записывание темы лекции, ее основных вопросов, рекомендуемой литературы;</li>
<li>- перед очередной лекцией необходимо просмотреть по конспекту материал предыдущей лекции. При затруднениях в восприятии материала следует обратиться к основным литературным источникам, если разобраться в материале опять не удалось, то обратиться к лектору (по графику его консультаций) или к преподавателю на практических занятиях. </li>
</ul>
<div></div>
<h3 style="text-align: center">13.3. Рекомендации по подготовке к практическим (семинарским) занятиям</h2>

<p style="text-indent: 15px; text-align: justify">Студентам следует:</p>
<ul style="list-style-type:none">
<li>- приносить с собой рекомендованную преподавателем литературу к конкретному занятию;</li>
<li>- до очередного практического занятия по рекомендованным литературным источникам проработать теоретический материал, соответствующей темы занятия;</li>
<li>- при подготовке к практическим занятиям следует обязательно использовать не только лекции, учебную литературу, но и нормативно-правовые акты и материалы правоприменительной практики;</li>
<li>- теоретический материал следует соотносить с правовыми нормами, так как в них могут быть внесены изменения, дополнения, которые не всегда отражены в учебной литературе;</li>
<li>- в начале занятий задать преподавателю вопросы по материалу, вызвавшему затруднения в его понимании и освоении при решении задач, заданных для самостоятельного решения;</li>
<li>- в ходе семинара давать конкретные, четкие ответы по существу вопросов;</li>
<li>- на занятии доводить каждую задачу до окончательного решения, демонстрировать понимание проведенных расчетов (анализов, ситуаций), в случае затруднений обращаться к преподавателю.</li>
</ul>
<div></div>
<h3 style="text-align: center">12.3. Методические рекомендации по выполнению различных форм самостоятельных домашних заданий</h2>

<p style="text-indent: 15px; text-align: justify">Самостоятельная работа студентов включает в себя выполнение различного рода заданий, которые ориентированы на более глубокое усвоение материала изучаемой дисциплины. По каждой теме учебной дисциплины студентам предлагается перечень заданий для самостоятельной работы.</p>
<p style="text-indent: 15px; text-align: justify">К выполнению заданий для самостоятельной работы предъявляются следующие требования: задания должны исполняться самостоятельно и представляться в установленный срок, а также соответствовать установленным требованиям по оформлению.</p>
<p style="text-indent: 15px; text-align: justify">Студентам следует:</p>
<ul style="list-style-type:none">
<li>- руководствоваться графиком самостоятельной работы, определенным РПД;</li>
<li>- выполнять все плановые задания, выдаваемые преподавателем для самостоятельного выполнения, и разбирать на семинарах и консультациях неясные вопросы;</li>
<li>- при подготовке к промежуточной аттестации параллельно прорабатывать соответствующие теоретические и практические разделы дисциплины, фиксируя неясные моменты для их обсуждения на плановой консультации.</li>
</ul>
<table  style="width: 33% !important;">
    <tr>
        <td style="text-align: center">
            <br>
            <br>
            <br><span style="color:#000000">{SP1}</span>
            <br>
            <br>
        </td>
    </tr>
    <tr>
        <td style="text-align: center">
            <br>
            <br>
            <br><span style="color:#000000">{SP2}</span>
            <br> 
            <br>
        </td> 
    </tr>
    <tr>
        <td style="text-align: center">
            <br>
            <br>
            <br><span style="color:#000000">{SP3}</span>
            <br>
            <br>
        </td>
       </tr>
    </tr>
</table>
HTML;

/*$fn = tempnam('/tmp/upload', 'sl7_');
ob_end_clean();*/

/*echo $html;
die();*/

$pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->page1footerhtml = 'Москва ' . $year;
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetMargins(25, 20, 15, true);
$tagvs = [
    'p' => [
        ['h' => 1.2],
        ['h' => 1.2,]
    ]
];
$pdf->setHtmlVSpace($tagvs);
$pdf->AddPage();
$pdf->PageNo();
$pdf->writeHTML($html, true, false, true, false, '');

$fileName = $json['static']['disciplineIndex'] . '_' . \date('d-m-Y', \strtotime($json['static']['syllabusData']['year'])) . '.pdf';
$path = $_SERVER['DOCUMENT_ROOT'] . 'oplyuyko_test/rpd/' . $fileName;
$link = 'https://lk.vavt.ru/oplyuyko_test/rpd/' . $fileName;

$pdf->Output($path, 'I');

//die(\json_encode(['link' => $link], JSON_UNESCAPED_UNICODE));

function escape4PDF($str)
{

    $allowedTags = '<p><li><ul><h1><h2><h3><h4><b><i><strong><br><tr><table><th><td><b><span>';

    $str = \trim(\strip_tags($str, $allowedTags));
    $str = \preg_replace('/&nbsp;+/', ' ', $str);
    $str = \preg_replace('/\s{2,}/', ' ', $str);
    $str = \preg_replace('/style="([\s\S]+?)"|class="([\s\S]+?)"/', '', $str);
    $str = \preg_replace('/width="([\s\S]+?)"/', '', $str);
    $str = \preg_replace('/p>\s+?/', 'p>', $str);
    /*    $str = \preg_replace('/<p>\s*<br>\s*<\/p>/','',$str);
        $str = \preg_replace('/<p>\s*<\/p>/','',$str);*/
    $str = \preg_replace('/<\s*\w+\s*>(\s*(<br>)*\s*)*<\/\s*\w+\s*>/', '', $str);

    return $str;
}
