<?php

require_once(__DIR__ . "/../vendor/autoload.php");

use VAVT\UP\PDF;

\ini_set('display_errors', 1);
\error_reporting(E_ALL  & ~E_NOTICE & ~E_WARNING);

$json = \json_decode(\file_get_contents('php://input'),true)['data'];
$json = \json_decode(\file_get_contents('mockRPD.json'),true);
$allowedTags = '<p><li><ul><h1><h2><h3><h4><b><i><strong><span><br><tr><table><th><td>';

$static = $json["static"];
$syllabusData = $static["syllabusData"];
$disciplineValue = $static["disciplineValue"];
$unitTitles = $static["unitTitles"];

$managed = $json["managed"];
$competencies = $managed["competencies"];
$disciplineStructure = $managed["disciplineStructure"];
$year = \date('Y',\strtotime($syllabusData["syllabusYear"]));

$html = '<span style="text-align: center">
        ФЕДЕРАЛЬНОЕ ГОСУДАРСТВЕННОЕ БЮДЖЕТНОЕ ОБРАЗОВАТЕЛЬНОЕ 
        <br>УЧРЕЖДЕНИЕ ВЫСШЕГО ОБРАЗОВАНИЯ
        <br>«ВСЕРОССИЙСКАЯ АКАДЕМИЯ ВНЕШНЕЙ ТОРГОВЛИ 
        <br>МИНИСТЕРСТВА ЭКОНОМИЧЕСКОГО РАЗВИТИЯ РОССИЙСКОЙ ФЕДЕРАЦИИ»
        </span>
        <p> </p>
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
        </table>
        <p> </p>';
$html .= <<<HTML
<h3 style="text-align: center"><strong>Рабочая программа учебной дисциплины</strong></h3>
<h3 style="text-align: center"><b>{$static["disciplineIndex"]}  {$static["name"]} </b></h3>
<span style="text-align: center">{$syllabusData["specialCode"]}  «{$syllabusData["special"]} »</span>
<br><br><span style="text-align: center">Профиль – «{$syllabusData["profile"]} »</span>
<p></p>
<span style="text-align: center">Квалификация (степень) выпускника – {$syllabusData["educationLevel"]} </span>
<br><br><span style="text-align: center">Форма обучения – {$syllabusData["educationForm"]} </span>
<p></p>
<span style="text-align: center">Год набора – $year г.</span>
<p></p>

<br pagebreak="true"/>
<span style="text-align: left">Разработчик программы: <br></span>
<span style="text-align: left"><i>{$managed['authors']['author']['FIO']}</i>, {$managed['authors']['author']['position']}</span>
<br>
<br>
<span style="text-align: left">Рецензенты: <br></span>
<span style="text-align: left"><i>{$managed['authors']['reviewer']['FIO']}</i>, {$managed['authors']['reviewer']['position']}</span>
<br pagebreak="true"/>

<h3 style="text-align: center">1. {$unitTitles[1]["title"]}  <br></h3>
{$managed["disciplineTarget"]}
<h3 style="text-align: center">2. {$unitTitles[2]["title"]} <br></h3>
{$managed["disciplinePlace"]}
<h3 style="text-align: center">3. {$unitTitles[3]["title"]}<br></h3>


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
         ';

HTML;

$html .= '<tbody>';
$tabPart2 = '';
$tabPart3 = '';
$firstRow = true;
foreach ($competencies as $firstCol) {
    $rowspan = '';
    foreach ($firstCol["nextLvl"] as $secondCol) {
        $rowspan2 = '';
        foreach ($secondCol["results"] as $thirdCol) {
            $rowspan += count($thirdCol);
            $rowspan2 += count($thirdCol);
        }
        $thirdCol = $secondCol["results"];

        $counter = count($thirdCol["able"]);
        foreach ($thirdCol["able"] as $able) {
            $tabPart3 .= '<td>' . $able["value"] . '</td>';
            if ($counter > 1) {
                $tabPart3 .= '</tr>';
                $tabPart3 .= '<tr>';
            } else {
                $tabPart3 .= '</tr>';
            }
            $counter = $counter - 1;
        }
        $counter = count($thirdCol["know"]);
        $tabPart3 .= '<tr>';
        foreach ($thirdCol["know"] as $know) {
            $tabPart3 .= '<td>' . $know["value"] . '</td>';
            if ($counter > 1) {
                $tabPart3 .= '</tr>';
                $tabPart3 .= '<tr>';
            } else {
                $tabPart3 .= '</tr>';
            }
            $counter = $counter - 1;
        }
        $counter = count($thirdCol["master"]);
        $tabPart3 .= '<tr>';
        foreach ($thirdCol["master"] as $master) {
            $tabPart3 .= '<td>' . $master["value"] . '</td>';
            if ($counter > 1) {
                $tabPart3 .= '</tr>';
                $tabPart3 .= '<tr>';
            } else {
                $tabPart3 .= '</tr>';
            }
            $counter = $counter - 1;
        }
        if ($firstRow == false) {
            $tabPart2 .= '<tr>';
        }
        $tabPart2 .= '<td rowspan="' . $rowspan2 . '" >' . $secondCol["competenceCipher"] . '. ' . $secondCol["name"] . '</td>';
        $tabPart2 .= $tabPart3;
        $firstRow = false;
        $tabPart3 = '';

    }
    $html .= '<tr>';
    $html .= '<td rowspan="' . $rowspan . '">' . $firstCol["competenceCipher"] . '. ' . $firstCol["name"] . '</td>';
    $html .= $tabPart2;
    $firstRow = true;
    $tabPart2 = '';
}


$html .= '</tbody>
        </table>';

$html .= '<h3 style="text-align: center">4.'.$unitTitles[4]["title"] .'<br></h3>';

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
            if (\is_array($semestersHour["controlName"])){
                $semestersHour["controlName"] = \implode('-',$semestersHour["controlName"]);
            }
            $html .= '<td style="text-align: center; vertical-align: middle;">' . $strongOpen . $semestersHour["controlName"] . $strongClose . '</td>';
        }
    } else {
        foreach ($dv["semesters"] as $semestersHour) {
            $quantity = '-';
            if (\is_array($semestersHour["quantity"])){
                $semestersHour["quantity"] = \implode('-',$semestersHour["quantity"]);
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

$html .= '</tbody>';
$html .= '</table>';
$html .= '<h3 style="text-align: center"> Структура и содержание дисциплины (модуля) </h3>';//ToDo header должен быть в json

$html .= '<table  style=": 100%" border="1">
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
                    <strong>В том числе в форме практической подготовки</strong> 
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
         ';
$html .= '<tbody>';
$n = 0;
foreach ($disciplineStructure as $ds) {
    $n++;
$html .=
    <<<HTML
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
$html .= '</tbody>';
$html .= '</table>';
$html .= '<br pagebreak="true"/>';

$html .= '<h3 style="text-align: center">5. '.$unitTitles[5]["title"] .'<br></h3>';

//$html .= '<p></p>';

//$html.='<br>';
$html .= '<h3 style="text-align: center">5.1. '.$unitTitles[5]["subUnits"][1]["title"] .'<br></h3>';
$n = 0;
foreach ($disciplineStructure as $ds) {
    $n++;
    $html .= '<h3 style="text-align: center">Тема '.$n.'. '.$ds["title"].'</h3>';
    $html .= '<p></p>';
    $html .= '<h3 style="text-align: center">Семестр ' . $ds["semester"] . '<br></h3>';
    $html .= strip_tags($ds["theme"], $allowedTags);

}

$html .= '<h3 style="text-align: center">5.2 '.$unitTitles[5]["subUnits"][2]["title"] .'</h3>';
foreach ($disciplineStructure as $ds) {
    if (is_null($ds["seminars"])){
        continue;
    }
    $html .= '<h3 style="text-align: center">Тема '.$ds["title"].'</h3>';

    $html .= '<p></p>';
    $n = 0;
    foreach ($ds["seminars"] as $seminar) {

        $n++;

        $html .= '<h3 style="text-align: center">Семинар ' . $n . '</h3>';
        $html .= strip_tags($seminar, $allowedTags);
    }

}

$html .= '</tbody>';
$html .= '</table>';
$html .= '<h3 style="text-align: center">5.3.'.$unitTitles[5]["subUnits"][3]["title"] .'</h3>';

$html .= '<table  style=": 100%" border="1">
            <thead>
                <tr>
                    <th style="text-align: center">
                    № п/п
                    </th>
                    <th style="text-align: center">
                    Наименование раздела дисциплины
                    </th>
                    <th style="text-align: center">
                    Семестр 
                    </th>
                    <th style="text-align: center">
                    Вид самостоятельной работы 
                    </th>
                    <th style="text-align: center">
                    <strong> Трудоемкость <br> (в акад. <br> часах)</strong> 
                    </th>
                </tr>
            </thead>
         ';
$html .= '<tbody>';
$n = 0;
foreach ($disciplineStructure as $ds) {
    $n++;

    $html .= '<tr>';
    $html .= '<td style="text-align: center">' . $n . '</td>';
    $html .= '<td style="text-align: center">' . strip_tags($ds["title"], '') . '</td>';
    $html .= '<td style="text-align: center">' . $ds["semester"] . '</td>';
    $html .= '<td style="text-align: center">' . $ds["SRSDescription"] . '</td>';
    $html .= '<td style="text-align: center">' . $ds["load"]["SRS"] . '</td>';

    $html .= '</tr>';


}
$html .= '</tbody>';
$html .= '</table>';
$html .= '<br pagebreak="true"/>';



$html .= '<h3 style="text-align: center">6.'.$unitTitles["disciplineModules"]["title"].'</h3>';



$html .= "</p>";
$html .= '<table ><tr><td style="text-align: right; : 5cm;">';
$html .= '</td><td style=": 9cm;">';
$html .= '&nbsp;';
$html .= '</td><td style="text-align: left;">';
$html .= '</td></tr></table>';




$fn = tempnam('/tmp/upload', 'sl7_');
ob_end_clean();

//echo $html; die();

$pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->page1footerhtml = 'Москва ' . $year;
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);


$pdf->AddPage();
$pdf->PageNo();
$pdf->writeHTML($html, true, false, true, false, '');

$fileName =  $json['static']['disciplineIndex'] . '_' . \date('d-m-Y', \strtotime($json['static']['syllabusData']['year'])) . '.pdf';
$path = $_SERVER['DOCUMENT_ROOT'] . 'oplyuyko_test/rpd/' . $fileName;
$link = '/oplyuyko_test/rpd/'. $fileName;
$pdf->Output($path, 'I');


//echo "<a href='https://lk.vavt.ru".$link."' target='_blank'>link</a>";

//die(\json_encode(['link' => $link], JSON_UNESCAPED_UNICODE));

