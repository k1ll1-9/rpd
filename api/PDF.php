<?php



\ini_set('display_errors', 1);
\error_reporting(E_ALL  & ~E_NOTICE);

$allowedTags = '<p><li><ul><h1><h2><h3><h4><b><i><strong><span><br><tr><table><th><td>';

$data = \file_get_contents('php://input');
\parse_str($data,$json);

$static = $json["static"];
$syllabusData = $static["syllabusData"];
$disciplineValue = $static["disciplineValue"];
$unitTitles = $static["unitTitles"];

$managed = $json["managed"];
$competencies = $managed["competencies"];
$disciplineStructure = $managed["disciplineStructure"];

$html = '<span style="text-align: center">
        ФЕДЕРАЛЬНОЕ ГОСУДАРСТВЕННОЕ БЮДЖЕТНОЕ ОБРАЗОВАТЕЛЬНОЕ 
        <br>УЧРЕЖДЕНИЕ ВЫСШЕГО ОБРАЗОВАНИЯ
        <br>«ВСЕРОССИЙСКАЯ АКАДЕМИЯ ВНЕШНЕЙ ТОРГОВЛИ 
        <br>МИНИСТЕРСТВА ЭКОНОМИЧЕСКОГО РАЗВИТИЯ РОССИЙСКОЙ ФЕДЕРАЦИИ»
        </span>';
$html .= '<p> </p>';
$html .= '<table  style=": 100%">
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
        </table>';//ToDo утверждающего указывает из предложенного списка автор РПД
$html .= '<p> </p>';
$html .= '<h3 style="text-align: center"><strong>Рабочая программа учебной дисциплины</strong></h3>';
$html .= '<h3 style="text-align: center"><b>' .$static["disciplineIndex"] .' '. $static["name"] . '</b></h3>';
//$html.='<h3 style="text-align: center"><b>(английский язык)</b></h3>';//#ToDo здесь данные из JSON
$html .= '<span style="text-align: center">' . $syllabusData["specialCode"] . ' «' . $syllabusData["special"] . '»</span>';
$html .= '<br><br><span style="text-align: center">Профиль – «' . $syllabusData["profile"] . '»</span>';
$html .= '<p> </p>';
$html .= '<span style="text-align: center">Квалификация (степень) выпускника – ' . $syllabusData["educationLevel"] . '</span>';//
$html .= '<br><br><span style="text-align: center">Форма обучения – ' . $syllabusData["educationForm"] . '</span>';//
$html .= '<p> </p>';
$html .= '<span style="text-align: center">Год набора – ' . $syllabusData["syllabusYear"] . 'г.</span>';


$html .= '<p></p>';

$page1footerhtml = 'Москва ' . $syllabusData["syllabusYear"];

$html .= '<br pagebreak="true"/>';
$html .= '<span style="text-align: left">Разработчик программы: <br></span>';
$html .= '<span style="text-align: left"><i>Ткаченко И.Ю.</i>, к.ф.н., профессор кафедры мировой и национальной экономики  ВАВТ</span>';//#ToDo здесь данные из JSON
//$html .= '<span style="text-align: left"><i>Аверьянова С.В.</i>, зав. кафедрой английского языка (направление Международный бизнес), к.п.н., доцент</span>';//#ToDo здесь данные из JSON
$html .= '<span style="text-align: left">Рецензенты: <br></span>';
$html .= '<span style="text-align: left"><i>Кузнецова Г.В.</i>, к.э.н., доцент кафедры мировой экономики РЭУ им. Г.В. Плеханова </span>';//#ToDo здесь данные из JSON
//$html .= '<span style="text-align: left"><i>Степанова О.М.</i>, к.ф.н., доцент кафедры английского языка (направление Международный бизнес)</span>';//#ToDo здесь данные из JSON
$html .= '<br pagebreak="true"/>';

$html .= '<h3 style="text-align: left">1.'.$unitTitles["disciplineTarget"]["title"] .'  <br></h3>';
$html .= $managed["disciplineTarget"];//
$html .= '<h3 style="text-align: left">2.'.$unitTitles["disciplinePlace"]["title"] .' <br></h3>';
$html .='<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:115%;mso-outline-level:2;tab-stops:
right lined 17.0cm"><b><span style="font-size:12.0pt;line-height:115%;font-family:\&quot;Times New Roman\&quot;,serif;
mso-fareast-font-family:\&quot;Times New Roman\&quot;;mso-fareast-language:RU">2.1. Учебная
дисциплина (модуль) </span></b><span style="font-size:12.0pt;line-height:115%;
font-family:\&quot;Times New Roman\&quot;,serif;mso-fareast-font-family:\&quot;Times New Roman\&quot;;
mso-fareast-language:RU">«Мировая экономика» относится к </span><span style="font-size:12.0pt;line-height:115%;font-family:\&quot;Times New Roman\&quot;,serif">части
учебного плана, формируемой участниками образовательных отношений.</span><span style="font-size:12.0pt;line-height:115%;font-family:\&quot;Times New Roman\&quot;,serif;
mso-fareast-font-family:\&quot;Times New Roman\&quot;;mso-fareast-language:RU"> <o:p></o:p></span></p><p>

</p><p class="MsoNormal" style="text-align:justify;text-indent:35.45pt;line-height:
115%;text-autospace:none"><span style="font-size:12.0pt;line-height:115%;
font-family:\&quot;Times New Roman\&quot;,serif">Основой для изучения данной дисциплины
являются «Микроэкономика», «Макроэкономика». Дисциплина дает возможность более
подробно изучить общие закономерности развития мирового хозяйства и особенности
проявления этих закономерностей в конкретных экономических условиях.<o:p></o:p></span></p>';
$html .= '<h3 style="text-align: left">3.'.$unitTitles["competencies"]["title"] .'<br></h3>';


$html .= '<table  style=": 100%" border="1">
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

$html .= '<tbody>';
$tabPart2 = '';
$tabPart3 = '';
$firstRow = true;
foreach ($competencies as $firstCol) {
    $rowspan = '';
    foreach ($firstCol["nextLvl"] as $secondCol) {
        $rowspan2 = '';
//        $tabPart3 ='';
        foreach ($secondCol["results"] as $thirdCol) {
            $rowspan += count($thirdCol);
            $rowspan2 += count($thirdCol);
        }
//    print '<br>';
//    print $rowspan2;
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
        $tabPart2 .= '<td rowspan="' . $rowspan2 . '">' . $secondCol["competenceCipher"] . '. ' . $secondCol["name"] . '</td>';
        $tabPart2 .= $tabPart3;
        $firstRow = false;
        $tabPart3 = '';

    }
    $html .= '<tr>';
    $html .= '<td rowspan="' . $rowspan . '">' . $firstCol["competenceCipher"] . '. ' . $firstCol["name"] . '</td>';
    $html .= $tabPart2;
//    $html.= '</tr>';
    $firstRow = true;
    $tabPart2 = '';
//    $tabPart3 ='';
}


$html .= '</tbody>';

$html .= '</table>';

$html .= '<h3 style="text-align: left">4.'.$unitTitles["disciplineStructure"]["title"] .'<br></h3>';

$html .= '<h3 style="text-align: center"> Объем дисциплины и виды учебной работы </h3>';//ToDo из JSON
//$html.='<br>';
$colspan = count($static["semesters"]);
$html .= '<table  style=": 100%" border="1">
            <thead>
                <tr>
                    <th style="text-align: left" rowspan="2">
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
    $html .= '<td style="text-align: left">' . $strongOpen . $dv["label"]["value"] . $strongClose . '</td>';
    $total = '-';
    if ($dv["total"] == 0) {
        $html .= '<td style="text-align: center">' . $strongOpen . '-' . $strongClose . '</td>';
    } else {
        $html .= '<td style="text-align: center">' . $strongOpen . $dv["total"] . $strongClose . '</td>';
    }
    if ($dv["label"]["value"] == "Вид промежуточной аттестации") {
        foreach ($dv["semesters"] as $semestersHour) {
            $html .= '<td style="text-align: center">' . $strongOpen . $semestersHour["controlName"] . $strongClose . '</td>';
        }
    } else {
        foreach ($dv["semesters"] as $semestersHour) {
            $quantity = '-';
            if ($semestersHour["quantity"] == 0) {
                $html .= '<td style="text-align: center">' . $strongOpen . '-' . $strongClose . '</td>';
            } else {
                $html .= '<td style="text-align: center">' . $strongOpen . $semestersHour["quantity"] . $strongClose . '</td>';
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
                    <th style="text-align: center" rowspan="2">
                    № п/п
                    </th>
                    <th style="text-align: center" rowspan="2">
                    Наименование раздела дисциплины
                    </th>
                    <th style="text-align: center" rowspan="2">
                    Семестр 
                    </th>
                    <th style="text-align: center" colspan="3">
                    Вид учебной работы <br> (в академических часах) 
                    </th>
                    <th style="text-align: center" rowspan="2">
                    <strong> В том числе <br> в форме <br> практической <br> подготовки</strong> 
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

    $html .= '<tr>';
    $html .= '<td style="text-align: left">' . $n . '</td>';
    $html .= '<td style="text-align: left">' . $ds["title"] . '</td>';
    $html .= '<td style="text-align: left">' . $ds["semester"] . '</td>';
    $html .= '<td style="text-align: left">-</td>';//Л
    $html .= '<td style="text-align: left">' . $ds["load"]["seminars"] . '</td>';
    $html .= '<td style="text-align: left">' . $ds["load"]["SRS"] . '</td>';
    $html .= '<td style="text-align: left">-</td>';//В том числе в форме практической подготовки


    $html .= '</tr>';


}
$html .= '</tbody>';
$html .= '</table>';

$html .= '<h3 style="text-align: center">5. '.$unitTitles["disciplineModules"]["title"] .'<br></h3>';

//$html .= '<p></p>';

//$html.='<br>';
$html .= '<h3 style="text-align: center">5.1. '.$unitTitles["disciplineModules"]["subUnits"][0]["title"] .'<br></h3>';
$n = 0;
foreach ($disciplineStructure as $ds) {
    $n++;
    $html .= '<h3 style="text-align: center">Тема '.$n.'. '.$ds["title"].'</h3>';
    $html .= '<p></p>';
    $html .= '<h3 style="text-align: center">Семестр ' . $ds["semester"] . '<br></h3>';
    $html .= strip_tags($ds["theme"], $allowedTags);

}

$html .= '<h3 style="text-align: center">5.2 '.$unitTitles["disciplineModules"]["subUnits"][1]["title"] .'</h3>';
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
$html .= '<h3 style="text-align: center">5.3.'.$unitTitles["disciplineModules"]["subUnits"][2]["title"] .'</h3>';

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
//последнее


$html .= '<h3 style="text-align: center">6.'.$unitTitles["disciplineModules"]["title"].'</h3>';

//это мировая экономика
$html.= '<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt"><span style="font-size:12.0pt;line-height:107%;
font-family:&quot;Times New Roman&quot;,serif">При изучении дисциплины «Мировая
экономика» используются:<o:p></o:p></span></p><p class="a1" style="text-indent:35.45pt;line-height:normal"><span style="font-size:12.0pt">6.1. Традиционные образовательные технологии:<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l16 level1 lfo8;tab-stops:49.65pt 78.0pt"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">информационные
лекции;<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l16 level1 lfo8;tab-stops:49.65pt 78.0pt"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">занятия
семинарского типа (ЗСТ).<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt"><span style="font-size:12.0pt;line-height:107%;
font-family:&quot;Times New Roman&quot;,serif">Традиционные образовательные технологии
ориентируются на организацию образовательного процесса, предполагающую как
прямую трансляцию знаний от преподавателя к студенту в виде лекции
(преимущественно на основе объяснительно-иллюстративных методов обучения) так и
эвристическую беседу преподавателя и студентов, обсуждение заранее
подготовленных сообщений по каждому из вопросов плана занятий с единым для всех
перечнем рекомендуемой литературы (в форме семинара). <o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:normal;mso-outline-level:2;tab-stops:
right lined 17.0cm"><i><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Информационная лекция</span></i><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif"> используется при
изложении основных теоретических положений изучаемой дисциплины.<o:p></o:p></span></p><p class="a1CxSpFirst" style="text-indent:35.45pt;line-height:normal"><span style="font-size:12.0pt">&nbsp;</span></p><p class="a1CxSpLast" style="text-indent:35.45pt;line-height:normal"><span style="font-size:12.0pt">6.2. Технологии проблемного обучения: <o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l27 level1 lfo9;tab-stops:49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">проблемная лекция;<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt"><span style="font-size:12.0pt;line-height:107%;
font-family:&quot;Times New Roman&quot;,serif">Технологии проблемного обучения –
организация образовательного процесса, которая предполагает постановку проблемных
вопросов для стимулирования активной познавательной деятельности студентов. <o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt"><i><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Проблемная
лекция</span></i><span style="font-size:12.0pt;line-height:107%;font-family:
&quot;Times New Roman&quot;,serif"> используется при изложении вопросов, содержащих
проблемные и дискуссионные аспекты, где имеются различные научные подходы,
трактовки, точки зрения.&nbsp; Данный тип
технологий присутствует в той или иной степени практически во всех лекциях. <o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt"><span style="font-size:12.0pt;line-height:107%;
font-family:&quot;Times New Roman&quot;,serif">При изложении отдельных аспектов учебных
тем информационные лекции представляются в виде <i>лекций-визуализаций</i>, в которых изложение материала сопровождается
применением иллюстративных видеопрезентаций.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt"><span style="font-size:12.0pt;line-height:107%;
font-family:&quot;Times New Roman&quot;,serif">Особенностью данного курса дисциплины
является комплексное использование в ряде случаев как традиционных
образовательных технологий (информационная лекция) так и технологий проблемного
обучения (проблемная лекция) в рамках одного лекционного занятия при изложении
различных аспектов одной и той же темы. <o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;tab-stops:78.0pt"><span style="font-size:12.0pt;
line-height:107%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p><p class="a1" style="text-indent:35.45pt;line-height:normal"><em><span style="font-size:12.0pt">6.3. Информационно-коммуникационные образовательные
технологии</span></em><span style="font-size:12.0pt"> используются при
проведении занятий с использованием мультимедийной техники.<em>:</em><em><span style="font-style:normal;mso-bidi-font-style:italic"><o:p></o:p></span></em></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l19 level1 lfo10;tab-stops:
49.65pt 78.0pt"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:
Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">лекция-визуализация;<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l19 level1 lfo10;tab-stops:
49.65pt 78.0pt"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:
Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">практические
занятия в форме презентации. <o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:normal;mso-outline-level:2;tab-stops:
right lined 17.0cm"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:normal;mso-outline-level:2;tab-stops:
right lined 17.0cm"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:#00B050;mso-fareast-language:
RU;mso-bidi-font-weight:bold">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:normal;mso-outline-level:2;tab-stops:
right lined 17.0cm"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:#00B050;mso-fareast-language:
RU;mso-bidi-font-weight:bold">&nbsp;</span></p><p class="MsoNormal" align="center" style="text-indent: 35.4pt;"><b><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:HiddenHorzOCR">7. ОЦЕНОЧНЫЕ СРЕДСТВА<o:p></o:p></span></b></p><p class="MsoNormal" style="text-align:justify;mso-layout-grid-align:none;
text-autospace:none"><b><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:HiddenHorzOCR">Средства оценивания:<o:p></o:p></span></b></p><p class="MsoNormal" style="text-align:justify;mso-layout-grid-align:none;
text-autospace:none"><b><i><span style="font-size:12.0pt;line-height:
107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:HiddenHorzOCR">7.1.
Текущий контроль <o:p></o:p></span></i></b></p><p class="MsoNormal" style="margin-left:389.4pt;text-align:justify;text-indent:
35.4pt;mso-layout-grid-align:none;text-autospace:none"><b><i><span style="font-size:12.0pt;
line-height:107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
HiddenHorzOCR">Таблица 4<o:p></o:p></span></i></b></p>

<table class="MsoNormalTable" border="1" cellspacing="0" cellpadding="0" wiidth="0" style="border: none;">
 <tbody><tr style="mso-yfti-irow:0;mso-yfti-firstrow:yes;page-break-inside:avoid;
  height:43.6pt">
  <td wiidth="46" style="wiidth: 26.7pt; border-wiidth: 1pt; border-color: windowtext; border-image: initial; padding: 0cm 5.4pt; height: 43.6pt;">
  <p class="MsoNormal" align="center" style="margin-right: 5.65pt;"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">№п/п<o:p></o:p></span></p>
  </td>
  <td wiidth="363" style="wiidth: 277.85pt; border-top-wiidth: 1pt; border-right-wiidth: 1pt; border-bottom-wiidth: 1pt; border-top-color: windowtext; border-right-color: windowtext; border-bottom-color: windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt; height: 43.6pt;">
  <p class="MsoNormal" align="center"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Наименование
  раздела дисциплины<o:p></o:p></span></p>
  </td>
  <td wiidth="241" style="wiidth: 182.8pt; border-top-wiidth: 1pt; border-right-wiidth: 1pt; border-bottom-wiidth: 1pt; border-top-color: windowtext; border-right-color: windowtext; border-bottom-color: windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt; height: 43.6pt;">
  <p class="MsoNormal" align="center"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Средства
  текущего контроля<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:1;height:3.5pt">
  <td wiidth="46" style="wiidth: 26.7pt; border-right-wiidth: 1pt; border-bottom-wiidth: 1pt; border-left-wiidth: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoListParagraph" align="center" style="margin-left: 0cm; text-indent: 0cm;"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:&quot;Times New Roman&quot;">1.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:
  107%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p>
  </td>
  <td wiidth="363" valign="top" style="wiidth: 277.85pt; border-top: none; border-left: none; border-bottom-wiidth: 1pt; border-bottom-color: windowtext; border-right-wiidth: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoNormal" style="text-align:justify;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Мировая
  экономика: основные этапы становления и развития<o:p></o:p></span></p>
  </td>
  <td wiidth="241" style="wiidth: 182.8pt; border-top: none; border-left: none; border-bottom-wiidth: 1pt; border-bottom-color: windowtext; border-right-wiidth: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoNormal"><span style="font-size:12.0pt;
  line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Презентация результатов
  исследовательской деятельности<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:2;height:3.5pt">
  <td wiidth="46" style="wiidth: 26.7pt; border-right-wiidth: 1pt; border-bottom-wiidth: 1pt; border-left-wiidth: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoListParagraph" align="center" style="margin-left: 0cm; text-indent: 0cm;"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:&quot;Times New Roman&quot;">2.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:
  107%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p>
  </td>
  <td wiidth="363" valign="top" style="wiidth: 277.85pt; border-top: none; border-left: none; border-bottom-wiidth: 1pt; border-bottom-color: windowtext; border-right-wiidth: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoNormal" style="text-align:justify;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Основные
  тенденции развития современной мировой экономики<o:p></o:p></span></p>
  </td>
  <td wiidth="241" style="wiidth: 182.8pt; border-top: none; border-left: none; border-bottom-wiidth: 1pt; border-bottom-color: windowtext; border-right-wiidth: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoNormal"><span style="font-size:12.0pt;
  line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Презентация результатов
  исследовательской деятельности<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:3;height:3.5pt">
  <td wiidth="46" style="wiidth: 26.7pt; border-right-wiidth: 1pt; border-bottom-wiidth: 1pt; border-left-wiidth: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoListParagraph" align="center" style="margin-left: 0cm; text-indent: 0cm;"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:&quot;Times New Roman&quot;">3.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:
  107%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p>
  </td>
  <td wiidth="363" valign="top" style="wiidth: 277.85pt; border-top: none; border-left: none; border-bottom-wiidth: 1pt; border-bottom-color: windowtext; border-right-wiidth: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoNormal" style="text-align:justify;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Природные
  ресурсы современной мировой экономики<o:p></o:p></span></p>
  </td>
  <td wiidth="241" valign="top" style="wiidth: 182.8pt; border-top: none; border-left: none; border-bottom-wiidth: 1pt; border-bottom-color: windowtext; border-right-wiidth: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoNormal"><span style="font-size:12.0pt;
  line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Контрольная работа 1<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:4;height:3.5pt">
  <td wiidth="46" style="wiidth: 26.7pt; border-right-wiidth: 1pt; border-bottom-wiidth: 1pt; border-left-wiidth: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoListParagraph" align="center" style="margin-left: 0cm; text-indent: 0cm;"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:&quot;Times New Roman&quot;">4.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:
  107%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p>
  </td>
  <td wiidth="363" valign="top" style="wiidth: 277.85pt; border-top: none; border-left: none; border-bottom-wiidth: 1pt; border-bottom-color: windowtext; border-right-wiidth: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoNormal" style="text-align:justify;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Финансовые
  ресурсы современной мировой экономики и международные финансовые отношения.<o:p></o:p></span></p>
  </td>
  <td wiidth="241" valign="top" style="wiidth: 182.8pt; border-top: none; border-left: none; border-bottom-wiidth: 1pt; border-bottom-color: windowtext; border-right-wiidth: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoNormal"><span style="font-size:12.0pt;
  line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Контрольная работа 1<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:5;height:3.5pt">
  <td wiidth="46" style="wiidth: 26.7pt; border-right-wiidth: 1pt; border-bottom-wiidth: 1pt; border-left-wiidth: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoListParagraph" align="center" style="margin-left: 0cm; text-indent: 0cm;"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:&quot;Times New Roman&quot;">5.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:
  107%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p>
  </td>
  <td wiidth="363" valign="top" style="wiidth: 277.85pt; border-top: none; border-left: none; border-bottom-wiidth: 1pt; border-bottom-color: windowtext; border-right-wiidth: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoNormal" style="text-align:justify;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Научные
  и информационные ресурсы развития мирового хозяйства.<o:p></o:p></span></p>
  </td>
  <td wiidth="241" valign="top" style="wiidth: 182.8pt; border-top: none; border-left: none; border-bottom-wiidth: 1pt; border-bottom-color: windowtext; border-right-wiidth: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoNormal"><span style="font-size:12.0pt;
  line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Контрольная работа 1<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:6;height:3.5pt">
  <td wiidth="46" style="wiidth: 26.7pt; border-right-wiidth: 1pt; border-bottom-wiidth: 1pt; border-left-wiidth: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoListParagraph" align="center" style="margin-left: 0cm; text-indent: 0cm;"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:&quot;Times New Roman&quot;">6.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:
  107%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p>
  </td>
  <td wiidth="363" valign="top" style="wiidth: 277.85pt; border-top: none; border-left: none; border-bottom-wiidth: 1pt; border-bottom-color: windowtext; border-right-wiidth: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoNormal" style="text-align:justify;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Демографические
  ресурсы в современной мировой экономики и международная миграция населения и
  рабочей силы <o:p></o:p></span></p>
  </td>
  <td wiidth="241" valign="top" style="wiidth: 182.8pt; border-top: none; border-left: none; border-bottom-wiidth: 1pt; border-bottom-color: windowtext; border-right-wiidth: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoNormal"><span style="font-size:12.0pt;
  line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Контрольная работа 1<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:7;height:3.5pt">
  <td wiidth="46" style="wiidth: 26.7pt; border-right-wiidth: 1pt; border-bottom-wiidth: 1pt; border-left-wiidth: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoListParagraph" align="center" style="margin-left: 0cm; text-indent: 0cm;"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:&quot;Times New Roman&quot;">7.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:
  107%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p>
  </td>
  <td wiidth="363" valign="top" style="wiidth: 277.85pt; border-top: none; border-left: none; border-bottom-wiidth: 1pt; border-bottom-color: windowtext; border-right-wiidth: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoNormal" style="text-align:justify;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Классификация
  стран в мировой экономике. Роль развитых стран в современном мировом
  хозяйстве<o:p></o:p></span></p>
  </td>
  <td wiidth="241" valign="top" style="wiidth: 182.8pt; border-top: none; border-left: none; border-bottom-wiidth: 1pt; border-bottom-color: windowtext; border-right-wiidth: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoNormal"><span style="font-size:12.0pt;
  line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Презентация результатов
  исследовательской деятельности<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:8;height:3.5pt">
  <td wiidth="46" style="wiidth: 26.7pt; border-right-wiidth: 1pt; border-bottom-wiidth: 1pt; border-left-wiidth: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoListParagraph" align="center" style="margin-left: 0cm; text-indent: 0cm;"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:&quot;Times New Roman&quot;">8.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:
  107%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p>
  </td>
  <td wiidth="363" valign="top" style="wiidth: 277.85pt; border-top: none; border-left: none; border-bottom-wiidth: 1pt; border-bottom-color: windowtext; border-right-wiidth: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoNormal" style="text-align:justify;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Роль
  развивающихся стран в современном мировом хозяйстве<o:p></o:p></span></p>
  </td>
  <td wiidth="241" valign="top" style="wiidth: 182.8pt; border-top: none; border-left: none; border-bottom-wiidth: 1pt; border-bottom-color: windowtext; border-right-wiidth: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoNormal"><span style="font-size:12.0pt;
  line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Презентация результатов
  исследовательской деятельности<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:9;height:3.5pt">
  <td wiidth="46" style="wiidth: 26.7pt; border-right-wiidth: 1pt; border-bottom-wiidth: 1pt; border-left-wiidth: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoListParagraph" align="center" style="margin-left: 0cm; text-indent: 0cm;"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:&quot;Times New Roman&quot;">9.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:
  107%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p>
  </td>
  <td wiidth="363" valign="top" style="wiidth: 277.85pt; border-top: none; border-left: none; border-bottom-wiidth: 1pt; border-bottom-color: windowtext; border-right-wiidth: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoNormal" style="text-align:justify;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Роль
  стран с переходной экономикой в современном мировом хозяйстве <o:p></o:p></span></p>
  </td>
  <td wiidth="241" valign="top" style="wiidth: 182.8pt; border-top: none; border-left: none; border-bottom-wiidth: 1pt; border-bottom-color: windowtext; border-right-wiidth: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoNormal"><span style="font-size:12.0pt;
  line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Презентация результатов
  исследовательской деятельности<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:10;height:3.5pt">
  <td wiidth="46" style="wiidth: 26.7pt; border-right-wiidth: 1pt; border-bottom-wiidth: 1pt; border-left-wiidth: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoListParagraph" align="center" style="margin-left: 0cm; text-indent: 0cm;"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:&quot;Times New Roman&quot;">10.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:
  107%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p>
  </td>
  <td wiidth="363" valign="top" style="wiidth: 277.85pt; border-top: none; border-left: none; border-bottom-wiidth: 1pt; border-bottom-color: windowtext; border-right-wiidth: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoNormal" style="text-align:justify;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Глобальные
  проблемы современного развития. <o:p></o:p></span></p>
  </td>
  <td wiidth="241" valign="top" style="wiidth: 182.8pt; border-top: none; border-left: none; border-bottom-wiidth: 1pt; border-bottom-color: windowtext; border-right-wiidth: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoNormal"><span style="font-size:12.0pt;
  line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Контрольная работа 2<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:11;mso-yfti-lastrow:yes;height:3.5pt">
  <td wiidth="46" style="wiidth: 26.7pt; border-right-wiidth: 1pt; border-bottom-wiidth: 1pt; border-left-wiidth: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoListParagraph" align="center" style="margin-left: 0cm; text-indent: 0cm;"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:&quot;Times New Roman&quot;">11.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:
  107%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p>
  </td>
  <td wiidth="363" valign="top" style="wiidth: 277.85pt; border-top: none; border-left: none; border-bottom-wiidth: 1pt; border-bottom-color: windowtext; border-right-wiidth: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoNormal" style="text-align:justify;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Международное
  многостороннее экономическое сотрудничество.<o:p></o:p></span></p>
  </td>
  <td wiidth="241" valign="top" style="wiidth: 182.8pt; border-top: none; border-left: none; border-bottom-wiidth: 1pt; border-bottom-color: windowtext; border-right-wiidth: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 3.5pt;">
  <p class="MsoNormal"><span style="font-size:12.0pt;
  line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Контрольная работа 2<o:p></o:p></span></p>
  </td>
 </tr>
</tbody></table>

<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:normal;mso-outline-level:2;tab-stops:
right lined 17.0cm"><b><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:RU">&nbsp;</span></b></p><p class="MsoNormal" style="margin-top:0cm;margin-right:3.5pt;margin-bottom:0cm;
margin-left:0cm;margin-bottom:.0001pt"><span style="font-size:12.0pt;
line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Распределение
максимальных баллов по видам работы:<o:p></o:p></span></p><table class="MsoNormalTable" border="1" cellspacing="0" cellpadding="0" style="margin-left: 5.4pt; border: none;">
 <tbody><tr style="mso-yfti-irow:0;mso-yfti-firstrow:yes;height:22.45pt">
  <td ="91" valign="top" style=": 68.25pt; border-: 1pt; border-color: windowtext; border-image: initial; padding: 0cm 5.4pt; height: 22.45pt;">
  <p class="MsoNormal" align="center" style="margin: 0cm 3.5pt 0.0001pt 0cm;"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">№
  п/п</span><span lang="EN-US" style="font-size:12.0pt;line-height:107%;
  font-family:&quot;Times New Roman&quot;,serif;mso-ansi-language:EN-US"><o:p></o:p></span></p>
  </td>
  <td ="348" valign="top" style=": 261pt; border-top-: 1pt; border-right-: 1pt; border-bottom-: 1pt; border-top-color: windowtext; border-right-color: windowtext; border-bottom-color: windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt; height: 22.45pt;">
  <p class="MsoNormal" align="center" style="margin: 0cm 3.5pt 0.0001pt 0cm;"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Вид
  отчетности<o:p></o:p></span></p>
  </td>
  <td ="204" valign="top" style=": 152.7pt; border-top-: 1pt; border-right-: 1pt; border-bottom-: 1pt; border-top-color: windowtext; border-right-color: windowtext; border-bottom-color: windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt; height: 22.45pt;">
  <p class="MsoNormal" align="center" style="margin: 0cm 3.5pt 0.0001pt 0cm;"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Баллы<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:1;height:14.6pt">
  <td ="91" valign="top" style=": 68.25pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 14.6pt;">
  <p class="MsoNormal" align="center" style="margin: 0cm 3.5pt 0.0001pt 0cm; text-indent: 1.7pt;"><span style="font-size:12.0pt;line-height:107%;font-family:
  &quot;Times New Roman&quot;,serif">1.<o:p></o:p></span></p>
  </td>
  <td ="348" valign="top" style=": 261pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 14.6pt;">
  <p class="MsoNormal" style="margin-top:0cm;margin-right:3.5pt;margin-bottom:
  0cm;margin-left:0cm;margin-bottom:.0001pt"><span style="font-size:12.0pt;
  line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Текущая работа<o:p></o:p></span></p>
  </td>
  <td ="204" valign="top" style=": 152.7pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 14.6pt;">
  <p class="MsoNormal" align="center" style="margin: 0cm 3.5pt 0.0001pt 0cm;"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">50<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:2;height:13.9pt">
  <td ="91" valign="top" style=": 68.25pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 13.9pt;">
  <p class="MsoNormal" align="center" style="margin: 0cm 3.5pt 0.0001pt 0cm; text-indent: 1.7pt;"><span style="font-size:12.0pt;line-height:107%;font-family:
  &quot;Times New Roman&quot;,serif">2.<o:p></o:p></span></p>
  </td>
  <td ="348" valign="top" style=": 261pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 13.9pt;">
  <p class="MsoNormal" style="margin-top:0cm;margin-right:3.5pt;margin-bottom:
  0cm;margin-left:0cm;margin-bottom:.0001pt"><span style="font-size:12.0pt;
  line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Экзамен<o:p></o:p></span></p>
  </td>
  <td ="204" valign="top" style=": 152.7pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 13.9pt;">
  <p class="MsoNormal" align="center" style="margin: 0cm 3.5pt 0.0001pt 0cm;"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">50<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:3;mso-yfti-lastrow:yes;height:15.3pt">
  <td ="91" valign="top" style=": 68.25pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 15.3pt;">
  <p class="MsoNormal" align="center" style="margin: 0cm 3.5pt 0.0001pt 0cm; text-indent: 1.7pt;"><span style="font-size:12.0pt;line-height:107%;font-family:
  &quot;Times New Roman&quot;,serif">3.<o:p></o:p></span></p>
  </td>
  <td ="348" valign="top" style=": 261pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 15.3pt;">
  <p class="MsoNormal" style="margin-top:0cm;margin-right:3.5pt;margin-bottom:
  0cm;margin-left:0cm;margin-bottom:.0001pt"><span style="font-size:12.0pt;
  line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Итого:<o:p></o:p></span></p>
  </td>
  <td ="204" valign="top" style=": 152.7pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 15.3pt;">
  <p class="MsoNormal" align="center" style="margin: 0cm 3.5pt 0.0001pt 0cm;"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">100<o:p></o:p></span></p>
  </td>
 </tr>
</tbody></table><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:HiddenHorzOCR">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt"><span style="font-size:12.0pt;line-height:107%;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:HiddenHorzOCR">Оценка
знаний по 100-балльной шкале проводится в соответствии с нормативными
документами академии.</span><b><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:HiddenHorzOCR;mso-bidi-language:EN-US"><o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:normal;mso-outline-level:2;tab-stops:
right lined 17.0cm"><b><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:RU">&nbsp;</span></b></p><table class="MsoNormalTable" border="1" cellspacing="0" cellpadding="0" ="0" style="margin-left: 0.1pt; border: none;">
 <thead>
  <tr>
   <td ="39" style=": 30pt; border-: 1pt; border-color: windowtext; border-image: initial; padding: 0cm 5.4pt;">
   <p class="MsoNormal" align="center" style="margin-top: 2pt; line-height: 85%; vertical-align: baseline;"><b><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif">№
   п/п<o:p></o:p></span></b></p>
   </td>
   <td ="139" style=": 104.35pt; border-top-: 1pt; border-right-: 1pt; border-bottom-: 1pt; border-top-color: windowtext; border-right-color: windowtext; border-bottom-color: windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt;">
   <p class="MsoNormal" align="center" style="margin-top: 2pt; line-height: 85%; vertical-align: baseline;"><b><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif">Наименование
   раздела дисциплины (модуля)<o:p></o:p></span></b></p>
   </td>
   <td ="132" style=": 76.45pt; border-top-: 1pt; border-right-: 1pt; border-bottom-: 1pt; border-top-color: windowtext; border-right-color: windowtext; border-bottom-color: windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt;">
   <p class="MsoNormal" align="center" style="margin-top: 2pt; line-height: 85%; vertical-align: baseline;"><span class="s19"><b><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif">Компетенция(и)</span></b></span><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif"><o:p></o:p></span></p>
   </td>
   <td ="161" style=": 129.05pt; border-top-: 1pt; border-right-: 1pt; border-bottom-: 1pt; border-top-color: windowtext; border-right-color: windowtext; border-bottom-color: windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt;">
   <p class="MsoNormal" align="center" style="margin-top: 2pt; line-height: 85%; vertical-align: baseline;"><span class="s19"><b><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif">Индикатор(ы)
   достижения компетенции<o:p></o:p></span></b></span></p>
   </td>
   <td ="192" style=": 157.75pt; border-top-: 1pt; border-right-: 1pt; border-bottom-: 1pt; border-top-color: windowtext; border-right-color: windowtext; border-bottom-color: windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt;">
   <p class="MsoNormal" align="center" style="margin-bottom: 0.0001pt; line-height: 85%; vertical-align: baseline;"><span class="s19"><b><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif">Оценочные<o:p></o:p></span></b></span></p>
   <p class="MsoNormal" align="center" style="margin-bottom: 0.0001pt; line-height: 85%; vertical-align: baseline;"><span class="s19"><b><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif">средства
   текущего контроля успеваемости</span></b></span><span style="font-size:12.0pt;
   line-height:85%;font-family:&quot;Times New Roman&quot;,serif"><o:p></o:p></span></p>
   </td>
  </tr>
 </thead>
 <tbody><tr>
  <td ="39" style=": 30pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-bottom: 0.0001pt; line-height: normal; vertical-align: baseline;"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">1.<o:p></o:p></span></p>
  </td>
  <td ="139" valign="top" style=": 104.35pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-autospace:
  none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Мировая
  экономика: основные этапы становления и развития<o:p></o:p></span></p>
  </td>
  <td ="132" style=": 76.45pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-top: 2pt; line-height: 85%; vertical-align: baseline;"><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif">ПК-4<o:p></o:p></span></p>
  </td>
  <td ="161" valign="top" style=": 129.05pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-top: 2pt; line-height: 85%; vertical-align: baseline;"><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri;mso-bidi-font-style:italic">ИДК1. </span><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif;
  mso-bidi-font-weight:bold">ПК-4</span><span style="font-size:12.0pt;
  line-height:85%;font-family:&quot;Times New Roman&quot;,serif"><o:p></o:p></span></p>
  </td>
  <td ="192" style=": 157.75pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormalCxSpMiddle"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri">Домашнее задание (презентация по теме
  дисциплины).<o:p></o:p></span></p>
  <p class="MsoNormalCxSpMiddle" style="text-align:justify;text-autospace:ideograph-other"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td ="39" style=": 30pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-bottom: 0.0001pt; line-height: normal; vertical-align: baseline;"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">2.<o:p></o:p></span></p>
  </td>
  <td ="139" valign="top" style=": 104.35pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-autospace:
  none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Основные
  тенденции развития современной мировой экономики<o:p></o:p></span></p>
  </td>
  <td ="132" valign="top" style=": 76.45pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">ПК-4</span><o:p></o:p></p>
  </td>
  <td ="161" valign="top" style=": 129.05pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-top: 2pt; line-height: 85%; vertical-align: baseline;"><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri;mso-bidi-font-style:italic">ИДК2. </span><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif;
  mso-bidi-font-weight:bold">ПК-4.</span><span style="font-size:12.0pt;
  line-height:85%;font-family:&quot;Times New Roman&quot;,serif"><o:p></o:p></span></p>
  </td>
  <td ="192" style=": 157.75pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormalCxSpMiddle"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri">Домашнее задание (презентация по теме
  дисциплины).<o:p></o:p></span></p>
  <p class="MsoNormal" align="center" style="margin-top: 2pt; line-height: 85%; vertical-align: baseline;"><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td ="39" style=": 30pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-bottom: 0.0001pt; line-height: normal; vertical-align: baseline;"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">3.<o:p></o:p></span></p>
  </td>
  <td ="139" valign="top" style=": 104.35pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-autospace:
  none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Природные
  ресурсы современной мировой экономики<o:p></o:p></span></p>
  </td>
  <td ="132" valign="top" style=": 76.45pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">ПК-4</span><o:p></o:p></p>
  </td>
  <td ="161" valign="top" style=": 129.05pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri;mso-bidi-font-style:italic">ИДК1. </span><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-bidi-font-weight:bold">ПК-4</span><o:p></o:p></p>
  </td>
  <td ="192" style=": 157.75pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormalCxSpMiddle"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri">Домашнее задание (презентация по теме
  дисциплины).<o:p></o:p></span></p>
  <p class="MsoNormal" align="center" style="margin-top: 2pt; line-height: 85%; vertical-align: baseline;"><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td ="39" style=": 30pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-bottom: 0.0001pt; line-height: normal; vertical-align: baseline;"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">4.<o:p></o:p></span></p>
  </td>
  <td ="139" valign="top" style=": 104.35pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-autospace:
  none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Финансовые
  ресурсы современной мировой экономики и международные финансовые отношения.<o:p></o:p></span></p>
  </td>
  <td ="132" valign="top" style=": 76.45pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">ПК-4</span><o:p></o:p></p>
  </td>
  <td ="161" valign="top" style=": 129.05pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri;mso-bidi-font-style:italic">ИДК1. </span><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-bidi-font-weight:bold">ПК-4</span><o:p></o:p></p>
  </td>
  <td ="192" style=": 157.75pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormalCxSpMiddle"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri">Домашнее задание (презентация по теме
  дисциплины).<o:p></o:p></span></p>
  <p class="MsoNormal" align="center" style="margin-top: 2pt; line-height: 85%; vertical-align: baseline;"><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td ="39" style=": 30pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-bottom: 0.0001pt; line-height: normal; vertical-align: baseline;"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">5.<o:p></o:p></span></p>
  </td>
  <td ="139" valign="top" style=": 104.35pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-autospace:
  none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Научные
  и информационные ресурсы развития мирового хозяйства.<o:p></o:p></span></p>
  </td>
  <td ="132" valign="top" style=": 76.45pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">ПК-4</span><o:p></o:p></p>
  </td>
  <td ="161" valign="top" style=": 129.05pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-top: 2pt; line-height: 85%; vertical-align: baseline;"><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri;mso-bidi-font-style:italic">ИДК2. </span><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif;
  mso-bidi-font-weight:bold">ПК-4</span><span style="font-size:12.0pt;
  line-height:85%;font-family:&quot;Times New Roman&quot;,serif"><o:p></o:p></span></p>
  </td>
  <td ="192" style=": 157.75pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormalCxSpMiddle" style="text-align:justify;text-autospace:ideograph-other"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri">Контрольная работа<o:p></o:p></span></p>
  <p class="MsoNormal" align="center" style="margin-top: 2pt; line-height: 85%; vertical-align: baseline;"><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td ="39" style=": 30pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-bottom: 0.0001pt; line-height: normal; vertical-align: baseline;"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">6.<o:p></o:p></span></p>
  </td>
  <td ="139" valign="top" style=": 104.35pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-autospace:
  none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Демографические
  ресурсы в современной мировой экономики и международная миграция населения и
  рабочей силы<o:p></o:p></span></p>
  </td>
  <td ="132" valign="top" style=": 76.45pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">ПК-4</span><o:p></o:p></p>
  </td>
  <td ="161" valign="top" style=": 129.05pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-top: 2pt; line-height: 85%; vertical-align: baseline;"><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri;mso-bidi-font-style:italic">ИДК1. </span><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif;
  mso-bidi-font-weight:bold">ПК-4</span><span style="font-size:12.0pt;
  line-height:85%;font-family:&quot;Times New Roman&quot;,serif"><o:p></o:p></span></p>
  </td>
  <td ="192" style=": 157.75pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormalCxSpMiddle"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri">Домашнее задание (презентация по теме
  дисциплины).<o:p></o:p></span></p>
  <p class="MsoNormal" align="center" style="margin-top: 2pt; line-height: 85%; vertical-align: baseline;"><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td ="39" style=": 30pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-bottom: 0.0001pt; line-height: normal; vertical-align: baseline;"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">7.<o:p></o:p></span></p>
  </td>
  <td ="139" valign="top" style=": 104.35pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-autospace:
  none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Классификация
  стран в мировой экономике. Роль развитых стран в современном мировом
  хозяйстве<o:p></o:p></span></p>
  </td>
  <td ="132" valign="top" style=": 76.45pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">ПК-4</span><o:p></o:p></p>
  </td>
  <td ="161" valign="top" style=": 129.05pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-top: 2pt; line-height: 85%; vertical-align: baseline;"><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri;mso-bidi-font-style:italic">ИДК1. </span><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif;
  mso-bidi-font-weight:bold">ПК-4</span><span style="font-size:12.0pt;
  line-height:85%;font-family:&quot;Times New Roman&quot;,serif"><o:p></o:p></span></p>
  </td>
  <td ="192" style=": 157.75pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormalCxSpMiddle"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri">Домашнее задание (презентация по теме
  дисциплины).<o:p></o:p></span></p>
  <p class="MsoNormal" align="center" style="margin-top: 2pt; line-height: 85%; vertical-align: baseline;"><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td ="39" style=": 30pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-bottom: 0.0001pt; line-height: normal; vertical-align: baseline;"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">8.<o:p></o:p></span></p>
  </td>
  <td ="139" valign="top" style=": 104.35pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-autospace:
  none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Роль
  развивающихся стран в современном мировом хозяйстве<o:p></o:p></span></p>
  </td>
  <td ="132" valign="top" style=": 76.45pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">ПК-4</span><o:p></o:p></p>
  </td>
  <td ="161" valign="top" style=": 129.05pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-top: 2pt; line-height: 85%; vertical-align: baseline;"><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri;mso-bidi-font-style:italic">ИДК1. </span><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif;
  mso-bidi-font-weight:bold">ПК-4</span><span style="font-size:12.0pt;
  line-height:85%;font-family:&quot;Times New Roman&quot;,serif"><o:p></o:p></span></p>
  </td>
  <td ="192" style=": 157.75pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormalCxSpMiddle"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri">Домашнее задание (презентация по теме
  дисциплины).<o:p></o:p></span></p>
  <p class="MsoNormal" align="center" style="margin-top: 2pt; line-height: 85%; vertical-align: baseline;"><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td ="39" style=": 30pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-bottom: 0.0001pt; line-height: normal; vertical-align: baseline;"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">9.<o:p></o:p></span></p>
  </td>
  <td ="139" valign="top" style=": 104.35pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-autospace:
  none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Роль
  стран с переходной экономикой в современном мировом хозяйстве<o:p></o:p></span></p>
  </td>
  <td ="132" valign="top" style=": 76.45pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">ПК-4</span><o:p></o:p></p>
  </td>
  <td ="161" valign="top" style=": 129.05pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-top: 2pt; line-height: 85%; vertical-align: baseline;"><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri;mso-bidi-font-style:italic">ИДК1. </span><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif;
  mso-bidi-font-weight:bold">ПК-4</span><span style="font-size:12.0pt;
  line-height:85%;font-family:&quot;Times New Roman&quot;,serif"><o:p></o:p></span></p>
  </td>
  <td ="192" style=": 157.75pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormalCxSpMiddle"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri">Домашнее задание (презентация по теме
  дисциплины).<o:p></o:p></span></p>
  <p class="MsoNormal" align="center" style="margin-top: 2pt; line-height: 85%; vertical-align: baseline;"><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td ="39" style=": 30pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-bottom: 0.0001pt; line-height: normal; vertical-align: baseline;"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">10.<o:p></o:p></span></p>
  </td>
  <td ="139" valign="top" style=": 104.35pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-autospace:
  none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Глобальные
  проблемы современного развития.<o:p></o:p></span></p>
  </td>
  <td ="132" valign="top" style=": 76.45pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">ПК-4</span><o:p></o:p></p>
  </td>
  <td ="161" valign="top" style=": 129.05pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-top: 2pt; line-height: 85%; vertical-align: baseline;"><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri;mso-bidi-font-style:italic">ИДК2. </span><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif;
  mso-bidi-font-weight:bold">ПК-4</span><span style="font-size:12.0pt;
  line-height:85%;font-family:&quot;Times New Roman&quot;,serif"><o:p></o:p></span></p>
  </td>
  <td ="192" style=": 157.75pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormalCxSpMiddle"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri">Домашнее задание (презентация по теме
  дисциплины).<o:p></o:p></span></p>
  <p class="MsoNormalCxSpMiddle" style="text-align:justify;text-autospace:ideograph-other"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td ="39" style=": 30pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-bottom: 0.0001pt; line-height: normal; vertical-align: baseline;"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">11.<o:p></o:p></span></p>
  </td>
  <td ="139" valign="top" style=": 104.35pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-autospace:
  none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Международное
  многостороннее экономическое сотрудничество.<o:p></o:p></span></p>
  </td>
  <td ="132" valign="top" style=": 76.45pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">ПК-4</span><o:p></o:p></p>
  </td>
  <td ="161" valign="top" style=": 129.05pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-top: 2pt; line-height: 85%; vertical-align: baseline;"><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri;mso-bidi-font-style:italic">ИДК1. </span><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif;
  mso-bidi-font-weight:bold">ПК-4</span><span style="font-size:12.0pt;
  line-height:85%;font-family:&quot;Times New Roman&quot;,serif"><o:p></o:p></span></p>
  </td>
  <td ="192" style=": 157.75pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormalCxSpMiddle" style="text-align:justify;text-autospace:ideograph-other"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri">Контрольная работа<o:p></o:p></span></p>
  <p class="MsoNormal" align="center" style="margin-top: 2pt; line-height: 85%; vertical-align: baseline;"><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td ="178" colspan="2" rowspan="2" style=": 134.35pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-top: 2pt; line-height: 85%; vertical-align: baseline;"><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif">Итого:<o:p></o:p></span></p>
  </td>
  <td ="132" rowspan="2" style=": 76.45pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-top: 2pt; line-height: 85%; vertical-align: baseline;"><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif">ПК-4<i><o:p></o:p></i></span></p>
  </td>
  <td ="161" style=": 129.05pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-top: 2pt; line-height: 85%; vertical-align: baseline;"><b><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif">Форма
  контроля</span></b><span style="font-size:12.0pt;line-height:85%;font-family:
  &quot;Times New Roman&quot;,serif"><o:p></o:p></span></p>
  </td>
  <td ="192" style=": 157.75pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-top: 2pt; line-height: 85%; vertical-align: baseline;"><b><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif">Собеседование<span style="background:yellow;mso-highlight:yellow"><o:p></o:p></span></span></b></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:13;mso-yfti-lastrow:yes;height:15.55pt">
  <td ="161" valign="top" style=": 129.05pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 15.55pt;">
  <p class="MsoNormal" align="center" style="margin-top: 2pt; line-height: 85%; vertical-align: baseline;"><i><span style="font-size:12.0pt;line-height:85%;font-family:&quot;Times New Roman&quot;,serif">Экзамен<o:p></o:p></span></i></p>
  </td>
  <td ="192" valign="top" style=": 157.75pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 15.55pt;">
  <p class="MsoNormal" style="margin-top:2.0pt;line-height:85%;tab-stops:right lined 17.0cm;
  mso-layout-grid-align:none;punctuation-wrap:simple;text-autospace:none;
  vertical-align:baseline"><span style="font-size:12.0pt;line-height:85%;
  font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p>
  </td>
 </tr>
</tbody></table><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:normal;mso-outline-level:2;tab-stops:
right lined 17.0cm"><b><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:RU">&nbsp;</span></b></p><p class="a1" style="text-indent:35.45pt;line-height:normal"><b><i><span style="font-size:12.0pt;
mso-fareast-font-family:HiddenHorzOCR">7.2. Промежуточная аттестация </span></i></b><span style="font-size:12.0pt">– экзамен<o:p></o:p></span></p><p class="MsoNormal" style="text-align:justify;mso-layout-grid-align:none;
text-autospace:none"><b><i><span style="font-size:12.0pt;line-height:
107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:HiddenHorzOCR">&nbsp;</span></i></b></p><p class="MsoNormal" style="text-align:justify;text-indent:35.45pt;mso-layout-grid-align:
none;text-autospace:none"><b><i><span style="font-size:12.0pt;line-height:
107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:HiddenHorzOCR">7.3.
Критерии оценки промежуточной аттестации<o:p></o:p></span></i></b></p><p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:424.8pt;margin-bottom:.0001pt;text-align:justify;mso-layout-grid-align:
none;text-autospace:none"><b><i><span style="font-size:12.0pt;line-height:
107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:HiddenHorzOCR">Таблица
5<o:p></o:p></span></i></b></p><table class="MsoTableGrid" border="1" cellspacing="0" cellpadding="0" style="border: none;">
 <tbody><tr>
  <td ="200" valign="top" style=": 150.1pt; border-: 1pt; border-color: windowtext; border-image: initial; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-bottom: 0.0001pt; line-height: normal;"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:HiddenHorzOCR">Отлично<o:p></o:p></span></p>
  </td>
  <td ="132" valign="top" style=": 99.35pt; border-top-: 1pt; border-right-: 1pt; border-bottom-: 1pt; border-top-color: windowtext; border-right-color: windowtext; border-bottom-color: windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-bottom: 0.0001pt; line-height: normal;"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:HiddenHorzOCR">Хорошо<o:p></o:p></span></p>
  </td>
  <td ="172" valign="top" style=": 124.5pt; border-top-: 1pt; border-right-: 1pt; border-bottom-: 1pt; border-top-color: windowtext; border-right-color: windowtext; border-bottom-color: windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-bottom: 0.0001pt; line-height: normal;"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:HiddenHorzOCR">Удовлетворительно<o:p></o:p></span></p>
  </td>
  <td ="188" valign="top" style=": 135.8pt; border-top-: 1pt; border-right-: 1pt; border-bottom-: 1pt; border-top-color: windowtext; border-right-color: windowtext; border-bottom-color: windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-bottom: 0.0001pt; line-height: normal;"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:HiddenHorzOCR">Неудовлетворительно<o:p></o:p></span></p>
  </td>
 </tr>
 <tr>
  <td ="200" valign="top" style=": 150.1pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Оценка
  <b>«отлично»</b> проставляется в случае,
  если студент глубоко и прочно усвоил материал; последовательно и логически
  стройно излагает материал; умеет тесно увязывать теорию с практикой; свободно
  справляется с заданиями, вопросами и другими видами применения знаний; правильно
  обосновывает принятое решение.<o:p></o:p></span></p>
  <p class="MsoListParagraph" style="margin:0cm;margin-bottom:.0001pt;mso-add-space:
  auto;line-height:normal"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Учебные
  достижения в семестровый период и результаты текущего контроля демонстрируют
  высокую степень овладения программным материалом; сумма набранных баллов
  составляет от 85 до 100 баллов<o:p></o:p></span></p>
  </td>
  <td ="132" valign="top" style=": 99.35pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Оценка
  <b>«хорошо»</b> проставляется в случае,
  если студент<o:p></o:p></span></p>
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">твердо
  знает материал; грамотно и по существу излагает ответы на поставленные
  вопросы, не допуская существенных неточностей; правильно применяет
  теоретические положения при решении практических вопросов и задач, владеет
  необходимыми навыками и приемами их выполнения.<o:p></o:p></span></p>
  <p class="MsoListParagraph" style="margin:0cm;margin-bottom:.0001pt;mso-add-space:
  auto;line-height:normal"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Учебные
  достижения в семестровый период и результаты текущего контроля демонстрируют
  хорошую степень овладения программным материалом; сумма набранных баллов
  составляет от 70 до 84 баллов.<o:p></o:p></span></p>
  </td>
  <td ="172" valign="top" style=": 124.5pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Оценка
  <b>«удовлетворительно»</b> проставляется
  в случае, если студент имеет знания только основного материала, но не усвоил
  его деталей; допускает неточности, недостаточно правильные формулировки,
  нарушая логические последовательности при изложении программного материала;
  испытывает затруднения при выполнении практических заданий.<o:p></o:p></span></p>
  <p class="MsoListParagraph" style="margin:0cm;margin-bottom:.0001pt;mso-add-space:
  auto;line-height:normal"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Учебные
  достижения в семестровый период и результаты текущего контроля демонстрируют
  достаточную (удовлетворительную) степень овладения программным материалом;
  сумма набранных баллов составляет от 52 до 69 баллов.<o:p></o:p></span></p>
  </td>
  <td ="188" valign="top" style=": 135.8pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Оценка
  <b>«неудовлетворительно» </b>проставляется
  в случае, если студент не имеет знания основного материала, не усвоил его
  деталей; допускает грубые ошибки в формулировках, нарушая логические
  последовательности при изложении программного материала;<o:p></o:p></span></p>
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">испытывает
  затруднения при выполнении практических заданий.<o:p></o:p></span></p>
  <p class="MsoListParagraph" style="margin:0cm;margin-bottom:.0001pt;mso-add-space:
  auto;line-height:normal"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Учебные
  достижения в семестровый период и результаты текущего контроля демонстрируют
  недостаточную (неудовлетворительную) степень овладения программным
  материалом; сумма набранных баллов составляет 51 и меньше.<o:p></o:p></span></p>
  </td>
 </tr>
</tbody></table><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:normal;mso-outline-level:2;tab-stops:
right lined 17.0cm"><b><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:#00B050;mso-fareast-language:
RU">&nbsp;</span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:normal;mso-outline-level:2;tab-stops:
right lined 17.0cm"><b><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:#00B050;mso-fareast-language:
RU">&nbsp;</span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:normal;mso-outline-level:2;tab-stops:
right lined 17.0cm"><b><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:RU">7.4.
Методические материалы, определяющие процедуры оценивания знаний, умений,
навыков и (или) опыта деятельности<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:normal;mso-outline-level:2;tab-stops:
right lined 17.0cm"><b><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:#00B050;mso-fareast-language:
RU">&nbsp;</span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt"><span style="font-size:12.0pt;line-height:107%;
font-family:&quot;Times New Roman&quot;,serif">Промежуточная аттестация студентов по
дисциплине «Мировая экономика» проводится в форме экзамена. <o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt"><span style="font-size:12.0pt;line-height:107%;
font-family:&quot;Times New Roman&quot;,serif">Оценка знаний студента на экзамене носит комплексный
характер, является балльной и определяется:<o:p></o:p></span></p><p class="MsoListParagraphCxSpFirst" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-indent:35.45pt;line-height:normal;mso-list:l11 level1 lfo17;
tab-stops:49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;
font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">ответом
студента на экзамене;<o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-indent:35.45pt;line-height:normal;mso-list:l11 level1 lfo17;
tab-stops:49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;
font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">учебными
достижениями в семестровый период. <o:p></o:p></span></p><p class="MsoListParagraphCxSpLast" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-indent:35.45pt;tab-stops:49.65pt"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Оценка
работы студента в течение семестра составляет в сумме до 50 баллов. <o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt"><span style="font-size:12.0pt;line-height:107%;
font-family:&quot;Times New Roman&quot;,serif">Студенту выставляется оценка в
соответствии с балльно-рейтинговой системой. Основой для определения баллов
служит уровень усвоения студентами материала, предусмотренного данной
дисциплиной.<o:p></o:p></span></p><p class="MsoListParagraph" style="margin:0cm;margin-bottom:.0001pt;mso-add-space:
auto;text-indent:35.45pt"><span style="font-size:12.0pt;line-height:107%;
font-family:&quot;Times New Roman&quot;,serif">Знания, умения и навыки студента
оцениваются на экзамене.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:normal;mso-outline-level:2;tab-stops:
right lined 17.0cm"><b><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:RU">&nbsp;</span></b></p><p class="MsoNormal" style="text-align:justify;text-indent:35.4pt;mso-layout-grid-align:
none;text-autospace:none"><b><span style="font-size:12.0pt;line-height:107%;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:HiddenHorzOCR">8. </span></b><b><span style="font-size:12.0pt;line-height:
107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:HiddenHorzOCR">Учебно-методическое
и информационное обеспечение дисциплины <o:p></o:p></span></b></p><p class="MsoNormal" style="text-align:justify;text-indent:35.45pt;mso-layout-grid-align:
none;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:HiddenHorzOCR">8.1.
<b><i>Основная
литература</i></b>:<o:p></o:p></span></p><p class="a1CxSpFirst" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l6 level1 lfo12;tab-stops:14.2pt 49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;;mso-font-kerning:
18.0pt">1.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;mso-font-kerning:
18.0pt">Международные экономические отношения: учебник для студентов вузов,
обучающихся по экономическим специальностям / под ред. В.Е. Рыбалкина, В.Б.
Мантусова. </span><span style="font-size:12.0pt">– 10-е изд., перераб. и доп. –
М. : ЮНИТИ-ДАНА, 2017. – 704 с. – (Серия «Золотой фонд российских учебников»). – ISBN 978-5-238-02619-0. – Текст: электронный. – URL: </span><a href="https://znanium.com/catalog/product/1028785"><span style="font-size: 12pt; color: windowtext; border: 1pt none windowtext; padding: 0cm;">https://znanium.com/catalog/product/1028785</span></a><span style="font-size:12.0pt;border:none windowtext 1.0pt;mso-border-alt:none windowtext 0cm;
padding:0cm"> </span><span style="font-size:12.0pt;mso-font-kerning:18.0pt"><o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:36.0pt;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;tab-stops:14.2pt"><span style="font-size:12.0pt;
mso-font-kerning:18.0pt">&nbsp;</span></p><p class="a1CxSpMiddle" style="margin-left:36.0pt;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;tab-stops:14.2pt"><b><i><span style="font-size:12.0pt;
mso-font-kerning:18.0pt">8.2. Дополнительная литература:<o:p></o:p></span></i></b></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l23 level1 lfo13;tab-stops:14.2pt 49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;">1.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><a href="https://www.imemo.ru/jour/meimo/index.php?page_id=690&amp;id=120&amp;jid=8021&amp;jj=49&amp;at=a"><span style="font-size:12.0pt;mso-bidi-font-style:italic">Андреева Т. Н.</span></a><span style="font-size:12.0pt"> </span><a href="https://www.imemo.ru/jour/meimo/index.php?page_id=685&amp;id=8035&amp;jid=49&amp;jj=49"><span style="font-size:12.0pt">Проблема ограничения трудовой миграции как основная
причина Брекзита</span></a><span style="font-size:12.0pt"> //Мировая экономика
и международные отношения. – 2017, № 8<o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l23 level1 lfo13;tab-stops:14.2pt 49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;">2.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><a href="https://www.imemo.ru/jour/meimo/index.php?page_id=690&amp;id=997&amp;jid=7803&amp;jj=49&amp;at=a"><span style="font-size:12.0pt;mso-bidi-font-style:italic">Антропов В.</span></a><span style="font-size:12.0pt"> </span><a href="https://www.imemo.ru/jour/meimo/index.php?page_id=685&amp;id=7815&amp;jid=49&amp;jj=49"><span style="font-size:12.0pt">Европейская социальная модель и политика жесткой
экономии</span></a><span style="font-size:12.0pt"> //Мировая экономика и
международные отношения. – 2017, № 3<o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l23 level1 lfo13;tab-stops:14.2pt 49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;">3.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><a href="https://www.imemo.ru/jour/meimo/index.php?page_id=690&amp;id=195&amp;jid=7803&amp;jj=49&amp;at=a"><span style="font-size:12.0pt;mso-bidi-font-style:italic">Воронов К. В.</span></a><span style="font-size:12.0pt"> </span><a href="https://www.imemo.ru/jour/meimo/index.php?page_id=685&amp;id=7814&amp;jid=49&amp;jj=49"><span style="font-size:12.0pt">Европейский порядок: мирная смена парадигмы?</span></a><span style="font-size:12.0pt"> //Мировая экономика и международные отношения. –
2017, № 3<o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l23 level1 lfo13;tab-stops:14.2pt 49.65pt"><a name="_Toc36041020"><!--[if !supportLists]--><span style="font-size:12.0pt;
mso-fareast-font-family:&quot;Times New Roman&quot;">4.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt">Долгов С. И., Савинов Ю.А.<span style="background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"> Глобализация: альтернативы нет //Российский внешнеэкономический вестник
</span>–<span style="background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"> 2017, № 9</span></span></a><span style="font-size:12.0pt"><o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l23 level1 lfo13;tab-stops:14.2pt 49.65pt"><a name="_Toc36041021"><!--[if !supportLists]--><span style="font-size:12.0pt;
mso-fareast-font-family:&quot;Times New Roman&quot;">5.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size: 12pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;">Иванов А.С., Матвеев И.Е.</span></a><span style="font-size:12.0pt"> </span><a href="http://www.rfej.ru/rvv/id/90024FE88"><span style="font-size: 12pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;">Международная торговля
энергоресурсами на рубеже 2018 года</span></a><span style="font-size: 12pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"> //Российский внешнеэкономический
вестник </span><span style="font-size:12.0pt">–<span style="background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"> 2018, № 2</span></span><span style="font-size: 12pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:14.2pt;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;tab-stops:14.2pt"><i><span style="font-size:12.0pt">&nbsp;</span></i></p><p class="a1CxSpMiddle" style="text-indent:35.45pt;line-height:normal;tab-stops:
21.3pt"><b><i><span style="font-size:12.0pt">8.3. Перечень информационных справочных
систем и профессиональных баз данных<o:p></o:p></span></i></b></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l12 level1 lfo14;tab-stops:14.2pt 49.65pt"><a name="_Toc36041025"><!--[if !supportLists]--><span style="font-size:12.0pt;
mso-fareast-font-family:&quot;Times New Roman&quot;">1.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt">«Доклад по вопросам глобальной финансовой
стабильности»[Электронный ресурс]. Режим
доступа: http://www.imf.org/external/ns/loe/cs.aspx?id=69</span></a><span style="font-size:12.0pt"><o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l12 level1 lfo14;tab-stops:14.2pt 49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;">2.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt">АТЭС: справочная
информация / Российский центр исследований АТЭС. [Электронный ресурс]. Режим
доступа: http: www.apec-center.ru <o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l12 level1 lfo14;tab-stops:14.2pt 49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;">3.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt">Будущее, которое
мы хотим. Итоговый документ Конференции Организации Объединенных Наций по
устойчивому развитию РИО+20.// [Электронный ресурс]. Режим доступа:
http://www.un.org/ru/sustainablefuture/<o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l12 level1 lfo14;tab-stops:14.2pt 49.65pt"><a name="_Toc36041026"><!--[if !supportLists]--><span style="font-size:12.0pt;
mso-fareast-font-family:&quot;Times New Roman&quot;">4.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt">Глобализация и взаимозависимость [Электронный ресурс].
Режим доступа:
http://www.un.org/ru/development/globalization/interdependence.shtml</span></a><span style="font-size:12.0pt"><o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l12 level1 lfo14;tab-stops:14.2pt 49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;">5.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt">Глобализация.
Учебные материалы Всемирного банка. [Электронный ресурс]. Режим доступа:
http://www.un.org/ru/youthink/globalization.shtml<o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l12 level1 lfo14;tab-stops:14.2pt 49.65pt"><a name="_Toc36041027"><!--[if !supportLists]--><span style="font-size:12.0pt;
mso-fareast-font-family:&quot;Times New Roman&quot;">6.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt">Индекс глобализации стран мира по версии KOF
[Электронный ресурс]. Режим доступа:
http://gtmarket.ru/ratings/kof-globalization-index/info [Электронный ресурс].
Режим доступа: http://www.eea.europa.eu/</span></a><span style="font-size:12.0pt"><o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l12 level1 lfo14;tab-stops:14.2pt 49.65pt"><a name="_Toc36041028"><!--[if !supportLists]--><span style="font-size:12.0pt;
mso-fareast-font-family:&quot;Times New Roman&quot;">7.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt">Интернет-ресурсы региональных интеграционных
группировок</span></a><span style="font-size:12.0pt"><o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l12 level1 lfo14;tab-stops:14.2pt 49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;">8.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt">Интернет-ресурсы
транснациональных корпораций<o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l12 level1 lfo14;tab-stops:14.2pt 49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;">9.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt">Информационно-библиографическая
система ООН: </span><a href="http://unbisnet.un.org/indexr.htm"><span style="font-size:12.0pt">[Электронный ресурс]. Режим доступа: http:
//unbisnet.un.org/indexr.htm</span></a><span style="font-size:12.0pt"> <o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l12 level1 lfo14;tab-stops:14.2pt 2.0cm"><!--[if !supportLists]--><span style="font-size:12.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;">10.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt">Лаппе Ф., Коллинз
Дж. и Россет П. Голод в Мире: 12 Мифов [Электронный ресурс]. Режим доступа:
http://ucmopuockon.livejournal.com/1693690.html?thread=5038586.<o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l12 level1 lfo14;tab-stops:14.2pt 2.0cm"><!--[if !supportLists]--><span style="font-size:12.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;">11.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt">Официальный сайт </span><span lang="EN-US" style="font-size:12.0pt;mso-ansi-language:EN-US">ASEAN</span><span style="font-size:12.0pt">. [Электронный ресурс]. Режим доступа: http: //www.a</span><span lang="EN-US" style="font-size:12.0pt;mso-ansi-language:EN-US">sean</span><span style="font-size:12.0pt">.org/<o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l12 level1 lfo14;tab-stops:14.2pt 2.0cm"><!--[if !supportLists]--><span style="font-size:12.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;">12.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt">Официальный сайт
АТЭС. </span><a href="http://www.apec.org/"><span style="font-size:12.0pt">[Электронный
ресурс]. Режим доступа: http: //www.apec.org/</span></a><span style="font-size:
12.0pt"><o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l12 level1 lfo14;tab-stops:14.2pt 2.0cm"><!--[if !supportLists]--><span style="font-size:12.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;">13.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt">Официальный сайт
БРИКС. [Электронный ресурс]. Режим доступа: http: //www.apec.org/<o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l12 level1 lfo14;tab-stops:14.2pt 2.0cm"><!--[if !supportLists]--><span style="font-size:12.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;">14.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt">Официальный сайт
ВАС [Электронный ресурс]. Режим доступа: http:
//www.asean.org/asean/external-relations/east-asia-summit-eas<o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l12 level1 lfo14;tab-stops:14.2pt 2.0cm"><!--[if !supportLists]--><span style="font-size:12.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;">15.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt">Официальный сайт
Евросоюза. </span><a href="http://europa.eu/"><span style="font-size:12.0pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; [Электронный ресурс]. Режим доступа:
http://europa.eu/</span></a><span style="font-size:12.0pt"><o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l12 level1 lfo14;tab-stops:14.2pt 2.0cm"><!--[if !supportLists]--><span style="font-size:12.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;">16.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt">Официальный сайт
ООН </span><a href="http://www.un.org/ru/"><span style="font-size:12.0pt">[Электронный
ресурс]. Режим доступа: http: //www.un.org/ru/</span></a><span style="font-size:12.0pt"><o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l12 level1 lfo14;tab-stops:14.2pt 2.0cm"><!--[if !supportLists]--><span style="font-size:12.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;">17.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt">Официальный сайт
правительства Китая &nbsp;&nbsp;&nbsp;&nbsp; [Электронный
ресурс]. Режим доступа: http: // </span><span lang="EN-US" style="font-size:12.0pt;
mso-ansi-language:EN-US">www</span><span style="font-size:12.0pt">.</span><span lang="EN-US" style="font-size:12.0pt;mso-ansi-language:EN-US">gov</span><span style="font-size:12.0pt">.</span><span lang="EN-US" style="font-size:12.0pt;
mso-ansi-language:EN-US">cn</span><span style="font-size:12.0pt">/</span><span lang="EN-US" style="font-size:12.0pt;mso-ansi-language:EN-US">english</span><span style="font-size:12.0pt">/<o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l12 level1 lfo14;tab-stops:14.2pt 2.0cm"><!--[if !supportLists]--><span style="font-size:12.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;">18.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt">Официальный сайт
правительства Республики Корея &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; [Электронный
ресурс]. Режим доступа: http: // </span><span lang="EN-US" style="font-size:12.0pt;
mso-ansi-language:EN-US">www</span><span style="font-size:12.0pt">.</span><span lang="EN-US" style="font-size:12.0pt;mso-ansi-language:EN-US">korea</span><span style="font-size:12.0pt">.</span><span lang="EN-US" style="font-size:12.0pt;
mso-ansi-language:EN-US">net</span><span style="font-size:12.0pt">/<o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l12 level1 lfo14;tab-stops:14.2pt 2.0cm"><!--[if !supportLists]--><span style="font-size:12.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;">19.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt">Официальный сайт
правительства США </span><a href="http://www.usa.gov/"><span style="font-size:
12.0pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; [Электронный ресурс]. Режим
доступа: http://www.usa.gov/</span></a><span style="font-size:12.0pt"><o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l12 level1 lfo14;tab-stops:14.2pt 2.0cm"><!--[if !supportLists]--><span style="font-size:12.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;">20.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt">Официальный сайт
правительства Японии </span><a href="http://www.kantei.go.jp/foreign/index-e.html"><span style="font-size:
12.0pt">&nbsp; [Электронный ресурс]. Режим
доступа: http: // www.kantei.go.jp/foreign/index-e.html</span></a><span style="font-size:12.0pt"><o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l12 level1 lfo14;tab-stops:14.2pt 2.0cm"><!--[if !supportLists]--><span lang="EN-US" style="font-size:12.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;;
mso-ansi-language:EN-US">21.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt">Официальный сайт статистического бюро Европейского
Союза [Электронный ресурс]. Режим</span><span style="font-size:12.0pt;
mso-ansi-language:EN-US"> </span><span style="font-size:12.0pt">доступа</span><span lang="EN-US" style="font-size:12.0pt;mso-ansi-language:EN-US">: http: //
epp.eurostat.ec.europa.eu/portal/page/portal/eurostat/home/<o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l12 level1 lfo14;tab-stops:14.2pt 2.0cm"><!--[if !supportLists]--><span style="font-size:12.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;">22.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size: 12pt; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;">Перспективы
мировой экономики [Электронный ресурс]. Режим доступа:
http://www.vsemirnyjbank.org/ru/publication/global-economic-prospects<o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l12 level1 lfo14;tab-stops:14.2pt 2.0cm"><!--[if !supportLists]--><span lang="EN-US" style="font-size:12.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;;
mso-ansi-language:EN-US">23.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt">Российский совет по международным делам. </span><a href="http://russiancouncil.ru/projects/project/?PROJECT_ID_4=6#top"><span lang="EN-US" style="font-size:12.0pt;mso-ansi-language:EN-US">[</span><span style="font-size:12.0pt">Электронный</span><span style="font-size:12.0pt;
mso-ansi-language:EN-US"> </span><span style="font-size:12.0pt">ресурс</span><span lang="EN-US" style="font-size:12.0pt;mso-ansi-language:EN-US">]. </span><span style="font-size:12.0pt">Режим</span><span style="font-size:12.0pt;mso-ansi-language:
EN-US"> </span><span style="font-size:12.0pt">доступа</span><span lang="EN-US" style="font-size:12.0pt;mso-ansi-language:EN-US">: http:
//russiancouncil.ru/projects/project/?PROJECT_ID_4=6#top</span></a><span lang="EN-US" style="font-size:12.0pt;mso-ansi-language:EN-US"><o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l12 level1 lfo14;tab-stops:14.2pt 2.0cm"><!--[if !supportLists]--><span style="font-size:12.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;;border:none windowtext 1.0pt;
mso-border-alt:none windowtext 0cm;padding:0cm">24.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span lang="EN-US" style="font-size:12.0pt;mso-ansi-language:EN-US">Alanna Petroff and
Ivana Kottasova Brexit triggered: 5 huge
obstacles to an amicable divorce [Электронный ресурс]. </span><span style="font-size:12.0pt">Режим доступа: </span><span lang="EN-US" style="font-size:12.0pt;border:none windowtext 1.0pt;mso-border-alt:none windowtext 0cm;
padding:0cm;mso-ansi-language:EN-US">http</span><span style="font-size:12.0pt;
border:none windowtext 1.0pt;mso-border-alt:none windowtext 0cm;padding:0cm">://</span><span lang="EN-US" style="font-size:12.0pt;border:none windowtext 1.0pt;mso-border-alt:
none windowtext 0cm;padding:0cm;mso-ansi-language:EN-US">money</span><span style="font-size:12.0pt;border:none windowtext 1.0pt;mso-border-alt:none windowtext 0cm;
padding:0cm">.</span><span lang="EN-US" style="font-size:12.0pt;border:none windowtext 1.0pt;
mso-border-alt:none windowtext 0cm;padding:0cm;mso-ansi-language:EN-US">cnn</span><span style="font-size:12.0pt;border:none windowtext 1.0pt;mso-border-alt:none windowtext 0cm;
padding:0cm">.</span><span lang="EN-US" style="font-size:12.0pt;border:none windowtext 1.0pt;
mso-border-alt:none windowtext 0cm;padding:0cm;mso-ansi-language:EN-US">com</span><span style="font-size:12.0pt;border:none windowtext 1.0pt;mso-border-alt:none windowtext 0cm;
padding:0cm">/2017/03/29/</span><span lang="EN-US" style="font-size:12.0pt;
border:none windowtext 1.0pt;mso-border-alt:none windowtext 0cm;padding:0cm;
mso-ansi-language:EN-US">news</span><span style="font-size:12.0pt;border:none windowtext 1.0pt;
mso-border-alt:none windowtext 0cm;padding:0cm">/</span><span lang="EN-US" style="font-size:12.0pt;border:none windowtext 1.0pt;mso-border-alt:none windowtext 0cm;
padding:0cm;mso-ansi-language:EN-US">economy</span><span style="font-size:12.0pt;
border:none windowtext 1.0pt;mso-border-alt:none windowtext 0cm;padding:0cm">/</span><span lang="EN-US" style="font-size:12.0pt;border:none windowtext 1.0pt;mso-border-alt:
none windowtext 0cm;padding:0cm;mso-ansi-language:EN-US">brexit</span><span style="font-size:12.0pt;border:none windowtext 1.0pt;mso-border-alt:none windowtext 0cm;
padding:0cm">-</span><span lang="EN-US" style="font-size:12.0pt;border:none windowtext 1.0pt;
mso-border-alt:none windowtext 0cm;padding:0cm;mso-ansi-language:EN-US">article</span><span style="font-size:12.0pt;border:none windowtext 1.0pt;mso-border-alt:none windowtext 0cm;
padding:0cm">-50-</span><span lang="EN-US" style="font-size:12.0pt;border:none windowtext 1.0pt;
mso-border-alt:none windowtext 0cm;padding:0cm;mso-ansi-language:EN-US">uk</span><span style="font-size:12.0pt;border:none windowtext 1.0pt;mso-border-alt:none windowtext 0cm;
padding:0cm">-</span><span lang="EN-US" style="font-size:12.0pt;border:none windowtext 1.0pt;
mso-border-alt:none windowtext 0cm;padding:0cm;mso-ansi-language:EN-US">eu</span><span style="font-size:12.0pt;border:none windowtext 1.0pt;mso-border-alt:none windowtext 0cm;
padding:0cm">-</span><span lang="EN-US" style="font-size:12.0pt;border:none windowtext 1.0pt;
mso-border-alt:none windowtext 0cm;padding:0cm;mso-ansi-language:EN-US">deal</span><span style="font-size:12.0pt;border:none windowtext 1.0pt;mso-border-alt:none windowtext 0cm;
padding:0cm">-</span><span lang="EN-US" style="font-size:12.0pt;border:none windowtext 1.0pt;
mso-border-alt:none windowtext 0cm;padding:0cm;mso-ansi-language:EN-US">obstacles</span><span style="font-size:12.0pt;border:none windowtext 1.0pt;mso-border-alt:none windowtext 0cm;
padding:0cm">/</span><span lang="EN-US" style="font-size:12.0pt;border:none windowtext 1.0pt;
mso-border-alt:none windowtext 0cm;padding:0cm;mso-ansi-language:EN-US">index</span><span style="font-size:12.0pt;border:none windowtext 1.0pt;mso-border-alt:none windowtext 0cm;
padding:0cm">.</span><span lang="EN-US" style="font-size:12.0pt;border:none windowtext 1.0pt;
mso-border-alt:none windowtext 0cm;padding:0cm;mso-ansi-language:EN-US">html</span><span style="font-size:12.0pt;border:none windowtext 1.0pt;mso-border-alt:none windowtext 0cm;
padding:0cm"><o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:0cm;mso-add-space:auto;text-indent:
35.45pt;line-height:normal;mso-list:l12 level1 lfo14;tab-stops:14.2pt 2.0cm"><!--[if !supportLists]--><span style="font-size:12.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;;border:none windowtext 1.0pt;
mso-border-alt:none windowtext 0cm;padding:0cm;mso-font-kerning:18.0pt">25.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;border:none windowtext 1.0pt;
mso-border-alt:none windowtext 0cm;padding:0cm;mso-font-kerning:18.0pt">BP
energy outlook [Электронный ресурс]. Режим доступа: </span><a href="https://www.bp.com/content/dam/bp/business-sites/en/global/corporate/pdfs/energy-economics/energy-outlook/bp-energy-outlook-2019.pdf"><span style="font-size:12.0pt">https://www.bp.com/content/dam/bp/business-sites/en/global/corporate/pdfs/energy-economics/energy-outlook/bp-energy-outlook-2019.pdf</span></a><span style="font-size:12.0pt;border:none windowtext 1.0pt;mso-border-alt:none windowtext 0cm;
padding:0cm;mso-font-kerning:18.0pt"><o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:35.45pt;mso-add-space:auto;text-indent:
0cm;line-height:normal;tab-stops:14.2pt 2.0cm"><span style="font-size:12.0pt">&nbsp;</span></p><p class="a1CxSpMiddle" style="text-indent:35.45pt;line-height:normal"><span style="font-size:12.0pt">&nbsp;</span></p><p class="a1CxSpMiddle" align="left" style="text-align:left;text-indent:35.45pt;
line-height:normal"><b><i><span style="font-size:12.0pt">8.5. Перечень программного обеспечения<o:p></o:p></span></i></b></p><p class="a1CxSpMiddle" style="margin-left:14.2pt;mso-add-space:auto;text-indent:
21.25pt;line-height:normal;mso-list:l0 level1 lfo11;tab-stops:49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;">1.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt">Операционная
система </span><span lang="EN-US" style="font-size:12.0pt;mso-ansi-language:EN-US">Windows</span><span style="font-size:12.0pt">;<o:p></o:p></span></p><p class="a1CxSpMiddle" style="margin-left:14.2pt;mso-add-space:auto;text-indent:
21.25pt;line-height:normal;mso-list:l0 level1 lfo11;tab-stops:49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;">2.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span lang="EN-US" style="font-size:12.0pt;
mso-ansi-language:EN-US">Microsoft</span><span lang="EN-US" style="font-size:
12.0pt"> </span><span lang="EN-US" style="font-size:12.0pt;mso-ansi-language:
EN-US">Office</span><span style="font-size:12.0pt">;<o:p></o:p></span></p><p class="a1CxSpLast" style="margin-left:14.2pt;mso-add-space:auto;text-indent:
21.25pt;line-height:normal;mso-list:l0 level1 lfo11;tab-stops:49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;mso-fareast-font-family:&quot;Times New Roman&quot;">3.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt">Антивирус </span><span lang="EN-US" style="font-size:12.0pt;mso-ansi-language:EN-US">Kaspersky</span><span style="font-size:12.0pt">.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:normal;mso-outline-level:2;tab-stops:
right lined 17.0cm"><b><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:RU">&nbsp;</span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:normal;mso-outline-level:2;tab-stops:
right lined 17.0cm"><b><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:RU">&nbsp;</span></b></p><p class="MsoListParagraph" style="margin-top:0cm;margin-right:0cm;margin-bottom:
0cm;margin-left:78.55pt;margin-bottom:.0001pt;mso-add-space:auto;text-align:
justify;text-indent:-18.0pt;line-height:normal;mso-outline-level:1;mso-list:
l18 level1 lfo18;tab-stops:49.65pt"><!--[if !supportLists]--><b><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">9.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></b><!--[endif]--><b><span style="font-size:12.0pt;font-family:
&quot;Times New Roman&quot;,serif">МАТЕРИАЛЬНО-ТЕХНИЧЕСКОЕ ОБЕСПЕЧЕНИЕ ДИСЦИПЛИНЫ<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
35.45pt;tab-stops:45.8pt 91.6pt 137.4pt 183.2pt 229.0pt 274.8pt 320.6pt 366.4pt 412.2pt 458.0pt 503.8pt 549.6pt 595.4pt 641.2pt 687.0pt 732.8pt"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
mso-bidi-font-weight:bold">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
35.45pt;tab-stops:45.8pt 91.6pt 137.4pt 183.2pt 229.0pt 274.8pt 320.6pt 366.4pt 412.2pt 458.0pt 503.8pt 549.6pt 595.4pt 641.2pt 687.0pt 732.8pt"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
mso-bidi-font-weight:bold">Реализация программы </span><span style="font-size:
12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">предполагает
наличие учебных кабинетов: <o:p></o:p></span></p><p class="MsoListParagraphCxSpFirst" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;line-height:normal;
mso-list:l20 level1 lfo1;tab-stops:45.8pt 91.6pt 137.4pt 183.2pt 229.0pt 274.8pt 320.6pt 366.4pt 412.2pt 458.0pt 503.8pt 549.6pt 595.4pt 641.2pt 687.0pt 732.8pt"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">лекционная
аудитория, оборудованная видеопроекционной аппаратурой, экраном, компьютером; <o:p></o:p></span></p><p class="MsoListParagraphCxSpLast" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;line-height:normal;
mso-list:l20 level1 lfo1;tab-stops:45.8pt 91.6pt 137.4pt 183.2pt 229.0pt 274.8pt 320.6pt 366.4pt 412.2pt 458.0pt 503.8pt 549.6pt 595.4pt 641.2pt 687.0pt 732.8pt"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">кабинет для
практических занятий (компьютерный класс), имеющий видеопроекционную аппаратуру
с возможностью подключения к ПК, экран, персональные компьютеры с возможностью
подключения к информационно-телекоммуникационной сети Internet.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
35.45pt;mso-pagination:none;tab-stops:49.65pt"><span style="font-size:12.0pt;
line-height:107%;font-family:&quot;Times New Roman&quot;,serif;color:#00B050">&nbsp;</span></p><p class="MsoListParagraph" align="center" style="margin: 0cm 0cm 0.0001pt; text-indent: 0cm; line-height: 115%;"><!--[if !supportLists]--><b><span style="font-size:12.0pt;line-height:
115%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">10.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;
</span></span></b><!--[endif]--><b><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif">ОБЕСПЕЧЕНИЕ
ДОСТУПНОСТИ ОСВОЕНИЯ ПРОГРАММЫ ОБУЧАЮЩИМИСЯ С ОГРАНИЧЕННЫМИ ВОЗМОЖНОСТЯМИ
ЗДОРОВЬЯ<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:21.3pt;margin-bottom:.0001pt;line-height:115%;mso-pagination:none;
tab-stops:21.3pt 49.65pt 137.4pt 183.2pt 229.0pt 274.8pt 320.6pt 366.4pt 412.2pt 458.0pt 503.8pt 549.6pt 595.4pt 641.2pt 687.0pt 732.8pt"><b><span style="font-size:12.0pt;line-height:
115%;font-family:&quot;Times New Roman&quot;,serif;color:#00B050">&nbsp;</span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:115%"><span style="font-size:12.0pt;
line-height:115%;font-family:&quot;Times New Roman&quot;,serif">Условия организации и
содержание обучения и контроля знаний обучающихся с ограниченными возможностями
здоровья (далее – ОВЗ) определяются программой дисциплины, адаптированной при
необходимости для обучения указанных обучающихся. <o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:115%"><span style="font-size:12.0pt;
line-height:115%;font-family:&quot;Times New Roman&quot;,serif">Организация обучения,
текущей и промежуточной аттестации студентов с ОВЗ осуществляется с учетом
особенностей психофизического развития, индивидуальных возможностей и состояния
здоровья таких обучающихся. Исходя из психофизического развития и состояния
здоровья студентов с ОВЗ, организуются занятия совместно с другими обучающимися
в общих группах, используя социально-активные и рефлексивные методы обучения
создания комфортного психологического климата в студенческой группе или, при
соответствующем заявлении такого обучающегося, по индивидуальной программе,
которая является модифицированным вариантом основной рабочей программы
дисциплины. При этом содержание программы дисциплины не изменяется. Изменяются,
как правило, формы обучения и контроля знаний, образовательные технологии и
учебно-методические материалы. <o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:115%"><span style="font-size:12.0pt;
line-height:115%;font-family:&quot;Times New Roman&quot;,serif">Обучение студентов с ОВЗ
также может осуществляться индивидуально и/или с применением элементов
электронного обучения. Электронное обучение обеспечивает возможность
коммуникаций с преподавателем, а также с другими обучаемыми посредством
вебинаров (например, с использованием программы Skype), что способствует
сплочению группы, направляет учебную группу на совместную работу, обсуждение,
принятие группового решения. В образовательном процессе для повышения уровня
восприятия и переработки учебной информации студентов с ОВЗ применяются мультимедийные
и специализированные технические средства приема-передачи учебной информации в
доступных формах для обучающихся с различными нарушениями, обеспечивается
выпуск альтернативных форматов печатных материалов (крупный шрифт), электронных
образовательных ресурсов в формах, адаптированных к ограничениям здоровья
обучающихся, наличие необходимого материально-технического оснащения. Подбор и
разработка учебных материалов производится преподавателем с учетом того, чтобы
обучающиеся с нарушениями слуха получали информацию визуально, с нарушениями
зрения – аудиально (например, с использованием программ-синтезаторов речи). <o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:115%"><span style="font-size:12.0pt;
line-height:115%;font-family:&quot;Times New Roman&quot;,serif">Для осуществления
процедур текущего контроля успеваемости и промежуточной аттестации обучающихся
лиц с ОВЗ оценочные средства по дисциплине, позволяющие оценить достижение ими
результатов обучения и уровень сформированности компетенций, предусмотренных
учебным планом и рабочей программой дисциплины, адаптируются для лиц с
ограниченными возможностями здоровья с учетом индивидуальных
психофизиологических особенностей (устно, письменно на бумаге, письменно на
компьютере, в форме тестирования и т.п.). При необходимости обучающимся
предоставляется дополнительное время для подготовки ответа при прохождении всех
видов аттестации.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:115%"><span style="font-size:12.0pt;
line-height:115%;font-family:&quot;Times New Roman&quot;,serif">Особые условия
предоставляются обучающиеся с ограниченными возможностями здоровья на основании
заявления, содержащего сведения о необходимости создания соответствующих
специальных условий.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:115%"><span style="font-size:12.0pt;
line-height:115%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p><p class="MsoNormal" align="center" style="margin-bottom: 0.0001pt; text-indent: 35.45pt; line-height: 115%;"><b><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Calibri">11. МЕТОДИЧЕСКИЕ УКАЗАНИЯ ДЛЯ ОБУЧАЮЩИХСЯ ПО
ОСВОЕНИЮ ДИСЦИПЛИНЫ<o:p></o:p></span></b></p><p class="MsoNormalCxSpMiddle" style="margin-bottom:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;line-height:115%"><b><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif">11.1.
Методические рекомендации по изучению дисциплины<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:115%"><span style="font-size:12.0pt;
line-height:115%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
Calibri">Студентам необходимо ознакомиться: с содержанием рабочей программы
дисциплины (далее – РПД), с целями и задачами дисциплины, ее связями с другими
дисциплинами образовательной программы, методическими разработками по данной
дисциплине, имеющимися на образовательном портале и сайте кафедры, с графиком
консультаций преподавателей данной кафедры.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:115%;mso-outline-level:5"><i><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif">Советы
по планированию и организации времени, необходимого на изучение дисциплины.<b> </b></span></i><span style="font-size:
12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-style:
italic">Рекомендуемое распределение времени на изучение дисциплины указано в
разделе «Структура и содержание дисциплины». В целях более плодотворной работы в семестре студенты также могут
ознакомиться с планом дисциплины, составленным преподавателем – как для
лекционных, так и для практических занятий.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:115%"><i><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Calibri;mso-bidi-font-weight:bold">«Сценарий» изучения
дисциплины.</span></i><span style="font-size:12.0pt;line-height:115%;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Calibri;mso-bidi-font-weight:
bold"> «Сценарий» изучения дисциплины студентом подразумевает выполнение им
следующих действий:<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:115%;mso-list:l15 level1 lfo5;tab-stops:list 49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold">·<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;line-height:115%;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Calibri;mso-bidi-font-weight:
bold">ознакомление с целями и задачами дисциплины;<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:115%;mso-list:l15 level1 lfo5;tab-stops:list 49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold">·<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;line-height:115%;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Calibri;mso-bidi-font-weight:
bold">ознакомление с требованиями к знаниям и навыкам студента;<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:115%;mso-list:l15 level1 lfo5;tab-stops:list 49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold">·<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;line-height:115%;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Calibri;mso-bidi-font-weight:
bold">первичное ознакомление с разделами и темами дисциплины;<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:115%;mso-list:l15 level1 lfo5;tab-stops:list 49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold">·<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;line-height:115%;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Calibri;mso-bidi-font-weight:
bold">ознакомление с распределением времени на изучение дисциплины;<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:115%;mso-list:l15 level1 lfo5;tab-stops:list 49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold">·<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;line-height:115%;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Calibri;mso-bidi-font-weight:
bold">ознакомление со списками рекомендуемой основной и дополнительной
литературы по дисциплине;<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:115%;mso-list:l15 level1 lfo5;tab-stops:list 49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold">·<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;line-height:115%;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Calibri;mso-bidi-font-weight:
bold">углублённое ознакомление с разделами и темами дисциплины;<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:115%;mso-list:l15 level1 lfo5;tab-stops:list 49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold">·<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;line-height:115%;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Calibri;mso-bidi-font-weight:
bold">предварительный охват на основе рекомендуемой литературы круга вопросов,
актуальных для конкретного занятия; <o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:115%;mso-list:l15 level1 lfo5;tab-stops:list 49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold">·<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;line-height:115%;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Calibri;mso-bidi-font-weight:
bold">самостоятельная проработка основного круга вопросов как каждого
последующего, так и каждого предыдущего занятия в свободное время между
занятиями по дисциплине;<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:115%;mso-list:l15 level1 lfo5;tab-stops:list 49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold">·<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;line-height:115%;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Calibri;mso-bidi-font-weight:
bold">присутствие и творческое участие на лекционных и семинарских /
практических занятиях;<o:p></o:p></span></p><p class="MsoListParagraphCxSpFirst" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;line-height:115%;
mso-list:l15 level1 lfo5;tab-stops:list 49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold">·<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;line-height:115%;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Calibri;mso-bidi-font-weight:
bold">выполнение требований планового текущего и итогового контроля; <o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;line-height:115%;
mso-list:l15 level1 lfo5;tab-stops:list 49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold">·<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;line-height:115%;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Calibri;mso-bidi-font-weight:
bold">уточнение возникающих вопросов на консультации по дисциплине;<o:p></o:p></span></p><p class="MsoListParagraphCxSpLast" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;line-height:115%;
mso-list:l15 level1 lfo5;tab-stops:list 49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol;mso-bidi-font-weight:bold">·<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;line-height:115%;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Calibri;mso-bidi-font-weight:
bold">непосредственная подготовка к экзамену по дисциплине на основе выданных
преподавателем вопросов к экзамену.<o:p></o:p></span></p><p class="MsoNormal" align="center" style="margin-bottom: 0.0001pt; text-indent: 1cm; line-height: 115%;"><b><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Calibri">&nbsp;</span></b></p><p class="MsoNormal" align="center" style="margin-bottom: 0.0001pt; line-height: 115%;"><b><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Calibri">11.2. Рекомендации по подготовке к лекционным
занятиям (теоретический курс)<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
1.0cm;line-height:115%"><span style="font-size:12.0pt;line-height:115%;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Calibri">Студентам
необходимо:<o:p></o:p></span></p><p class="MsoListParagraphCxSpFirst" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;line-height:115%;
mso-list:l2 level1 lfo4;tab-stops:49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol">·<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Calibri">перед каждой лекцией просматривать рабочую
программу дисциплины, что позволит сэкономить время на записывание темы лекции,
ее основных вопросов, рекомендуемой литературы;<o:p></o:p></span></p><p class="MsoListParagraphCxSpLast" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;line-height:115%;
mso-list:l2 level1 lfo4;tab-stops:49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol">·<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Calibri">перед очередной лекцией необходимо просмотреть
по конспекту материал предыдущей лекции. При затруднениях в восприятии
материала следует обратиться к основным литературным источникам, если
разобраться в материале опять не удалось, то обратиться к лектору (по графику
его консультаций) или к преподавателю на практических занятиях. <o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
1.0cm;line-height:115%"><span style="font-size:12.0pt;line-height:115%;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Calibri">&nbsp;<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:
115%"><b><span style="font-size:12.0pt;
line-height:115%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
Calibri">11.3. Рекомендации по подготовке к практическим (семинарским) занятиям<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
1.0cm;line-height:115%"><span style="font-size:12.0pt;line-height:115%;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Calibri">Студентам
следует:<o:p></o:p></span></p><p class="MsoListParagraphCxSpFirst" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;line-height:115%;
mso-list:l21 level1 lfo3;tab-stops:49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol">·<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Calibri">приносить с собой рекомендованную
преподавателем литературу к конкретному занятию;<o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;line-height:115%;
mso-list:l21 level1 lfo3;tab-stops:49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol">·<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Calibri">до очередного практического занятия по
рекомендованным литературным источникам проработать теоретический материал,
соответствующей темы занятия;<o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;line-height:115%;
mso-list:l21 level1 lfo3;tab-stops:49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol">·<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Calibri">при подготовке к практическим занятиям следует
обязательно использовать не только лекции, учебную литературу, но и
нормативно-правовые акты и материалы правоприменительной практики;<o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;line-height:115%;
mso-list:l21 level1 lfo3;tab-stops:49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol">·<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Calibri">теоретический материал следует соотносить с
правовыми нормами, так как в них могут быть внесены изменения, дополнения,
которые не всегда отражены в учебной литературе;<o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;line-height:115%;
mso-list:l21 level1 lfo3;tab-stops:49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol">·<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Calibri">в начале занятий задать преподавателю вопросы
по материалу, вызвавшему затруднения в его понимании и освоении при решении
задач, заданных для самостоятельного решения;<o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;line-height:115%;
mso-list:l21 level1 lfo3;tab-stops:49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol">·<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Calibri">в ходе семинара давать конкретные, четкие
ответы по существу вопросов;<o:p></o:p></span></p><p class="MsoListParagraphCxSpLast" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;line-height:115%;
mso-list:l21 level1 lfo3;tab-stops:49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol">·<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Calibri">на занятии доводить каждую задачу до
окончательного решения, демонстрировать понимание проведенных расчетов
(анализов, ситуаций), в случае затруднений обращаться к преподавателю.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
1.0cm;line-height:115%"><span style="font-size:12.0pt;line-height:115%;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Calibri">&nbsp;</span></p><p class="MsoNormalCxSpMiddle" align="center" style="margin-bottom: 0.0001pt; line-height: 115%;"><b><span style="font-size:12.0pt;line-height:
115%;font-family:&quot;Times New Roman&quot;,serif">11.4. Методические рекомендации по
выполнению различных форм самостоятельных домашних заданий<o:p></o:p></span></b></p><p class="MsoNormalCxSpMiddle" style="margin-bottom:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:1.0cm;line-height:115%"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Calibri">Самостоятельная работа студентов включает в
себя выполнение различного рода заданий, которые ориентированы на более
глубокое усвоение материала изучаемой дисциплины. По каждой теме учебной дисциплины
студентам предлагается перечень заданий для самостоятельной работы.<o:p></o:p></span></p><p class="MsoNormalCxSpMiddle" style="margin-bottom:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:1.0cm;line-height:115%"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Calibri">К выполнению заданий для самостоятельной
работы предъявляются следующие требования: задания должны исполняться
самостоятельно и представляться в установленный срок, а также соответствовать
установленным требованиям по оформлению.<o:p></o:p></span></p><p class="MsoNormalCxSpLast" style="margin-bottom:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:1.0cm;line-height:115%"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Calibri">Студентам следует:<o:p></o:p></span></p><p class="MsoListParagraphCxSpFirst" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;line-height:115%;
mso-list:l13 level1 lfo2;tab-stops:42.55pt 49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol">·<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Calibri">руководствоваться графиком самостоятельной
работы, определенным РПД;<o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;line-height:115%;
mso-list:l13 level1 lfo2;tab-stops:42.55pt 49.65pt"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol">·<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Calibri">выполнять все плановые задания, выдаваемые
преподавателем для самостоятельного выполнения, и разбирать на семинарах и
консультациях неясные вопросы;<o:p></o:p></span></p><p class="MsoListParagraphCxSpLast" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;line-height:115%;
mso-list:l13 level1 lfo2;tab-stops:42.55pt 45.8pt 49.65pt 91.6pt 137.4pt 183.2pt 229.0pt 274.8pt 320.6pt 366.4pt 412.2pt 458.0pt 503.8pt 549.6pt 595.4pt 641.2pt 687.0pt 732.8pt"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:115%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol">·<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:Calibri">при подготовке к промежуточной аттестации
параллельно прорабатывать соответствующие теоретические и практические разделы
дисциплины, фиксируя неясные моменты для их обсуждения на плановой
консультации.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
49.6pt;line-height:115%;mso-pagination:none;tab-stops:49.65pt"><span style="font-size:12.0pt;line-height:115%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p><p class="MsoNormal" align="center" style="margin-bottom: 0.0001pt; text-indent: 14.2pt;"><b><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:HiddenHorzOCR">12. </span></b><b><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
letter-spacing:.35pt">АННОТАЦИЯ РАБОЧЕЙ ПРОГРАММЫ ДИСЦИПЛИНЫ<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.4pt"><b><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
color:black;letter-spacing:.35pt">&nbsp;</span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.4pt;text-autospace:none"><b><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">1.
Цель дисциплины: </span></b><span style="font-size:12.0pt;line-height:107%;
font-family:&quot;Times New Roman&quot;,serif">овладение комплексными знаниями о мировой
экономике и международных экономических отношениях в современных условиях
глобализации. <b><o:p></o:p></b></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.4pt;text-autospace:none"><b><span style="font-size:12.0pt;
line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Задачи дисциплины:<o:p></o:p></span></b></p><p class="MsoListParagraphCxSpFirst" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;mso-list:l22 level2 lfo19;
tab-stops:49.65pt;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:107%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">познакомить
студентов с современными реалиями развития мирового хозяйства;<o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;mso-list:l22 level2 lfo19;
tab-stops:49.65pt;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:107%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">сформировать
навыки анализа и интерпретации факторов и причин происходящих
социально-экономических процессов;<o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;mso-list:l22 level2 lfo19;
tab-stops:49.65pt;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:107%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">изучить
основные тенденции развития современной мировой экономики;<o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;mso-list:l22 level2 lfo19;
tab-stops:49.65pt;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:107%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">проанализировать
основные тенденции в распределении и использовании ресурсов мирового хозяйства;<o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;mso-list:l22 level2 lfo19;
tab-stops:49.65pt;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:107%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">выработать
навыки анализа причин и последствий неравномерности экономического развития
стран и регионов;<o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;mso-list:l22 level2 lfo19;
tab-stops:49.65pt;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:107%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">освоить
навыки анализа экономического развития отдельных стран и их группировок в
мировой экономике;<o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;mso-list:l22 level2 lfo19;
tab-stops:49.65pt;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:107%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">изучить
основные подходы к развитию интеграционных процессов в различных регионах мира;<o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;mso-list:l22 level2 lfo19;
tab-stops:49.65pt;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:107%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">исследовать
основные глобальные проблемы, влияющие на развитие современной мировой
экономики, и существующие подходы к их разрешению;<o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;mso-list:l22 level2 lfo19;
tab-stops:49.65pt;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:107%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">освоить
навыки анализа материалов международных организаций, влияющих на развитие
мировой экономики и международных экономических отношений.<o:p></o:p></span></p><p class="MsoListParagraphCxSpLast" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;mso-list:l22 level2 lfo19;
tab-stops:49.65pt;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:107%;font-family:Symbol;mso-fareast-font-family:
Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">научить
студентов выявлять и оценивать взаимосвязи между текущими экономическими
явлениями, самостоятельно оценивать перспективы экономического роста и развития
различных стран и регионов.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.4pt;text-autospace:none"><b><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.4pt;text-autospace:none"><b><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">2.
Место дисциплины в структуре ООП бакалавриата<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.4pt;text-autospace:none"><span style="font-size:12.0pt;
line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Дисциплина относится к
обязательным дисциплинам вариативной части учебного плана. <b><o:p></o:p></b></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;text-autospace:none"><b><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">3.
Общая трудоемкость дисциплины 3 зачетные единицы (108 акад. час.).<o:p></o:p></span></b></p><p class="MsoListParagraphCxSpFirst" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;mso-list:l0 level1 lfo11;
tab-stops:49.65pt;text-autospace:none"><!--[if !supportLists]--><b><span style="font-size:12.0pt;line-height:
107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">4.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;
</span></span></b><!--[endif]--><b><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Семестр
изучения: 3.<o:p></o:p></span></b></p><p class="MsoListParagraphCxSpLast" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;mso-list:l0 level1 lfo11;
tab-stops:49.65pt;text-autospace:none"><!--[if !supportLists]--><b><span style="font-size:12.0pt;line-height:
107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">5.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;
</span></span></b><!--[endif]--><b><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">форма
контроля – экзамен.<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;tab-stops:49.65pt"><b><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
color:black;letter-spacing:.35pt">&nbsp;</span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.4pt"><b><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
color:black;letter-spacing:.35pt">&nbsp;</span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.4pt"><b><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
color:black;letter-spacing:.35pt">&nbsp;</span></b></p><p class="MsoListParagraph" style="margin-bottom:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:-18.0pt;line-height:normal;
mso-list:l10 level1 lfo6"><!--[if !supportLists]--><b><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:black;letter-spacing:.35pt">13.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-weight: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp; </span></span></b><!--[endif]--><b><span style="font-size:12.0pt;font-family:
&quot;Times New Roman&quot;,serif;color:black;letter-spacing:.35pt">ОЦЕНОЧНЫЕ МАТЕРИАЛЫ<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:18.0pt;margin-bottom:.0001pt;text-align:justify"><b><span style="font-size:12.0pt;line-height:
107%;font-family:&quot;Times New Roman&quot;,serif;color:black;letter-spacing:.35pt">&nbsp;</span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:normal;mso-outline-level:2;tab-stops:
right lined 17.0cm"><b><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:RU">13.1.
Паспорт оценочных средств<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:normal;mso-outline-level:2;tab-stops:
right lined 17.0cm"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:RU;mso-bidi-font-weight:
bold">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:normal;mso-outline-level:2;tab-stops:
right lined 17.0cm"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:RU;mso-bidi-font-weight:
bold">При проведении текущего контроля и промежуточной аттестации по дисциплине
(модулю) «<i>Мировая экономика</i>»
проверяется сформированность у обучающихся компетенций<i>, </i>указанных в разделе 3 настоящей программы<i>.</i></span><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">
Этапность формирования данных компетенций в процессе освоения образовательной
программы определяется последовательным освоением дисциплин (модулей) и
прохождением практик, а в процессе освоения дисциплины (модуля) – <span style="letter-spacing:-.2pt">последовательным достижением результатов освоения
содержательно связанных между собой разделов, тем.<o:p></o:p></span></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:normal;mso-outline-level:2;tab-stops:
right lined 17.0cm"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p><p class="MsoNormal" align="right" style="margin-left:18.0pt;text-align:right"><b><i><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
letter-spacing:.35pt">Таблица 6<o:p></o:p></span></i></b></p><p class="MsoNormal" align="center" style="margin-bottom: 0.0001pt; line-height: normal;"><b><span style="font-size:12.0pt;font-family:
&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:
RU">Соответствие разделов, тем дисциплины (модуля),<o:p></o:p></span></b></p><p class="MsoNormal" align="center" style="margin-bottom: 0.0001pt; line-height: normal;"><b><span style="font-size:12.0pt;font-family:
&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:
RU">результатов обучения по дисциплине (модулю) и оценочных средств<o:p></o:p></span></b></p><p class="MsoNormal" align="center" style="margin-bottom: 0.0001pt; line-height: normal;"><b><span style="font-size:12.0pt;font-family:
&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:
RU">&nbsp;</span></b></p><div align="center">

<table class="MsoNormalTable" border="1" cellspacing="0" cellpadding="0" ="0" style="border: none;">
 <tbody><tr>
  <td ="128" style=": 96.2pt; border-: 1pt; border-color: windowtext; border-image: initial; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-pagination:none;mso-hyphenate:none"><b><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-font-kerning:
  .5pt">Код и наименование<o:p></o:p></span></b></p>
  <p class="MsoNormal" align="center" style="margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-pagination:none;mso-hyphenate:none"><b><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-font-kerning:
  .5pt">компетенции<o:p></o:p></span></b></p>
  </td>
  <td ="180" valign="top" style=": 145.8pt; border-top-: 1pt; border-right-: 1pt; border-bottom-: 1pt; border-top-color: windowtext; border-right-color: windowtext; border-bottom-color: windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal"><b><span style="font-size:12.0pt;
  font-family:&quot;Times New Roman&quot;,serif">Код (ы) и наименование (-ия)
  индикатора(ов) <o:p></o:p></span></b></p>
  <p class="MsoNormal" align="center" style="margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal"><b><span style="font-size:12.0pt;
  font-family:&quot;Times New Roman&quot;,serif">достижения компетенций<o:p></o:p></span></b></p>
  </td>
  <td ="211" style=": 142.55pt; border-top-: 1pt; border-right-: 1pt; border-bottom-: 1pt; border-top-color: windowtext; border-right-color: windowtext; border-bottom-color: windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal"><b><span style="font-size:12.0pt;
  font-family:&quot;Times New Roman&quot;,serif;mso-font-kerning:.5pt">Планируемые
  результаты обучения <o:p></o:p></span></b></p>
  </td>
  <td ="140" valign="top" style=": 108.8pt; border-top-: 1pt; border-right-: 1pt; border-bottom-: 1pt; border-top-color: windowtext; border-right-color: windowtext; border-bottom-color: windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt;">
  <p class="MsoNormalCxSpMiddle" align="center" style="text-align:center;
  text-autospace:ideograph-other"><b><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri">Наименование оценочного средства</span></b><b><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-font-kerning:.5pt"><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr>
  <td ="128" rowspan="6" valign="top" style=": 96.2pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-pagination:none;mso-hyphenate:none"><b><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">ПК-4.</span></b><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif"> Способен
  применять современные инструменты и методы, позволяющие обеспечивать
  устойчивое развитие социально-экономической системы, стимулирование
  экономического развития и роста в глобальной экономике<i><o:p></o:p></i></span></p>
  </td>
  <td ="180" rowspan="3" valign="top" style=": 145.8pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt"><b><span style="font-size:12.0pt;line-height:
  107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Calibri;
  mso-bidi-font-style:italic">ИДК1. </span></b><b><span style="font-size:12.0pt;
  line-height:107%;font-family:&quot;Times New Roman&quot;,serif">ПК-4.</span></b><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">
  Демонстрирует знания современных отечественных и зарубежных инструментов и
  методов, позволяющих обеспечить устойчивое развитие социально-экономической
  системы, стимулирование экономического развития и роста в глобальной
  экономике.<i><o:p></o:p></i></span></p>
  </td>
  <td ="211" valign="top" style=": 142.55pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormalCxSpLast" style="margin-bottom:0cm;margin-bottom:.0001pt;
  mso-add-space:auto;text-align:justify"><span style="font-size:12.0pt;
  line-height:107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
  Calibri">Знать:<o:p></o:p></span></p>
  <p class="MsoListParagraph" style="margin-top:0cm;margin-right:0cm;margin-bottom:
  0cm;margin-left:17.5pt;margin-bottom:.0001pt;mso-add-space:auto;text-align:
  justify;text-indent:-14.2pt;line-height:normal;mso-pagination:none;
  mso-list:l14 level1 lfo16;mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:Symbol;mso-fareast-font-family:Symbol;
  mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
  &quot;Arial Unicode MS&quot;">базовые экономические понятия, законы и закономерности
  развития всемирного хозяйства.</span><b><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
  Calibri"><o:p></o:p></span></b></p>
  </td>
  <td ="140" rowspan="2" valign="top" style=": 108.8pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormalCxSpFirst"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri">1.Домашнее задание (презентация по теме
  дисциплины).<o:p></o:p></span></p>
  <p class="MsoNormalCxSpMiddle" style="text-align:justify;text-autospace:ideograph-other"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri">2. Контрольная работа<o:p></o:p></span></p>
  <p class="MsoNormalCxSpMiddle" style="text-align:justify;text-autospace:ideograph-other"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri">&nbsp;</span></p>
  <p class="MsoNormalCxSpMiddle" style="margin-bottom:0cm;margin-bottom:.0001pt;
  mso-add-space:auto;text-align:justify"><span style="font-size:12.0pt;
  line-height:107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
  Calibri">&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td ="211" valign="top" style=": 142.55pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-pagination:none;mso-layout-grid-align:none;text-autospace:none"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
  &quot;Arial Unicode MS&quot;">Уметь:<o:p></o:p></span></p>
  <p class="MsoListParagraphCxSpFirst" style="margin-top:0cm;margin-right:0cm;
  margin-bottom:0cm;margin-left:17.5pt;margin-bottom:.0001pt;mso-add-space:
  auto;text-align:justify;text-indent:-14.2pt;line-height:normal;mso-pagination:
  none;mso-list:l14 level1 lfo16;mso-layout-grid-align:none;text-autospace:
  none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:Symbol;
  mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:
  &quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Arial Unicode MS&quot;">идентифицировать
  уровень и состояние развития национальных и региональных экономических
  систем;<o:p></o:p></span></p>
  <p class="MsoListParagraphCxSpMiddle" style="margin-top:0cm;margin-right:0cm;
  margin-bottom:0cm;margin-left:17.5pt;margin-bottom:.0001pt;mso-add-space:
  auto;text-align:justify;text-indent:-14.2pt;line-height:normal;mso-pagination:
  none;mso-list:l14 level1 lfo16;mso-layout-grid-align:none;text-autospace:
  none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:Symbol;
  mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:
  &quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Arial Unicode MS&quot;">анализировать
  экономический потенциал различных стран и интеграционных группировок;<o:p></o:p></span></p>
  <p class="MsoListParagraphCxSpLast" style="margin-top:0cm;margin-right:0cm;
  margin-bottom:0cm;margin-left:17.5pt;margin-bottom:.0001pt;mso-add-space:
  auto;text-align:justify;text-indent:-14.2pt;line-height:normal;mso-pagination:
  none;mso-list:l14 level1 lfo16;mso-layout-grid-align:none;text-autospace:
  none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:Symbol;
  mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:
  &quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Arial Unicode MS&quot;">исследовать
  важнейшие направления взаимодействия России и ведущих стран мира.</span><b><span style="font-size:12.0pt;font-family:
  &quot;Times New Roman&quot;,serif;mso-fareast-font-family:Calibri"><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr>
  <td ="211" valign="top" style=": 142.55pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-pagination:none;mso-layout-grid-align:none;text-autospace:none"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
  &quot;Arial Unicode MS&quot;">Владеть:<o:p></o:p></span></p>
  <p class="MsoListParagraphCxSpFirst" style="margin-top:0cm;margin-right:0cm;
  margin-bottom:0cm;margin-left:17.5pt;margin-bottom:.0001pt;mso-add-space:
  auto;text-align:justify;text-indent:-14.2pt;line-height:normal;mso-pagination:
  none;mso-list:l14 level1 lfo16;mso-layout-grid-align:none;text-autospace:
  none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:Symbol;
  mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:
  &quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Arial Unicode MS&quot;">терминологией
  в данной области знаний; <o:p></o:p></span></p>
  <p class="MsoListParagraphCxSpMiddle" style="margin-top:0cm;margin-right:0cm;
  margin-bottom:0cm;margin-left:17.5pt;margin-bottom:.0001pt;mso-add-space:
  auto;text-align:justify;text-indent:-14.2pt;line-height:normal;mso-pagination:
  none;mso-list:l14 level1 lfo16;mso-layout-grid-align:none;text-autospace:
  none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:Symbol;
  mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:
  &quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Arial Unicode MS&quot;">знанием
  источников информации о мировом хозяйстве, публикаций ООН и других
  международных организаций по вопросам состояния и перспектив развития мировой
  экономики;<o:p></o:p></span></p>
  <p class="MsoListParagraphCxSpMiddle" style="margin-top:0cm;margin-right:0cm;
  margin-bottom:0cm;margin-left:17.5pt;margin-bottom:.0001pt;mso-add-space:
  auto;text-align:justify;text-indent:-14.2pt;line-height:normal;mso-pagination:
  none;mso-list:l14 level1 lfo16;mso-layout-grid-align:none;text-autospace:
  none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:Symbol;
  mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:
  &quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Arial Unicode MS&quot;">навыками
  подготовки содержательного обзора социально-экономической информации по
  узкоспециализированной теме;<o:p></o:p></span></p>
  <p class="MsoListParagraphCxSpMiddle" style="margin-top:0cm;margin-right:0cm;
  margin-bottom:0cm;margin-left:17.5pt;margin-bottom:.0001pt;mso-add-space:
  auto;text-align:justify;text-indent:-14.2pt;line-height:normal;mso-pagination:
  none;mso-list:l14 level1 lfo16;mso-layout-grid-align:none;text-autospace:
  none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:Symbol;
  mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:
  &quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Arial Unicode MS&quot;">навыками
  использования современных компьютерных программ для наглядного предоставления
  полученных результатов исследования; <o:p></o:p></span></p>
  <p class="MsoListParagraphCxSpMiddle" style="margin-top:0cm;margin-right:0cm;
  margin-bottom:0cm;margin-left:17.5pt;margin-bottom:.0001pt;mso-add-space:
  auto;text-align:justify;text-indent:-14.2pt;line-height:normal;mso-pagination:
  none;mso-list:l14 level1 lfo16;mso-layout-grid-align:none;text-autospace:
  none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:Symbol;
  mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:
  &quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Arial Unicode MS&quot;">навыками
  ведения дискуссии и полемики по вопросам функционирования современного
  мирового хозяйственного механизма и макроэкономической̆ политики государства;<o:p></o:p></span></p>
  <p class="MsoListParagraphCxSpMiddle" style="margin-top:0cm;margin-right:0cm;
  margin-bottom:0cm;margin-left:17.5pt;margin-bottom:.0001pt;mso-add-space:
  auto;text-align:justify;text-indent:-14.2pt;line-height:normal;mso-pagination:
  none;mso-list:l14 level1 lfo16;mso-layout-grid-align:none;text-autospace:
  none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:Symbol;
  mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:
  &quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Arial Unicode MS&quot;">навыками
  экономического анализа и критического восприятия экономической информации о
  тенденциях развития национальной экономики;<o:p></o:p></span></p>
  <p class="MsoListParagraphCxSpMiddle" style="margin-top:0cm;margin-right:0cm;
  margin-bottom:0cm;margin-left:17.5pt;margin-bottom:.0001pt;mso-add-space:
  auto;text-align:justify;text-indent:-14.2pt;line-height:normal;mso-pagination:
  none;mso-list:l14 level1 lfo16;mso-layout-grid-align:none;text-autospace:
  none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:Symbol;
  mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:
  &quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Arial Unicode MS&quot;">способностью&nbsp; готовить аналитические материалы для оценки
  мероприятий в области экономической политики и принятия стратегических
  решений на микро- и макроуровне;<o:p></o:p></span></p>
  <p class="MsoListParagraphCxSpLast" style="margin-top:0cm;margin-right:0cm;
  margin-bottom:0cm;margin-left:17.5pt;margin-bottom:.0001pt;mso-add-space:
  auto;text-align:justify;text-indent:-14.2pt;line-height:normal;mso-pagination:
  none;mso-list:l14 level1 lfo16;mso-layout-grid-align:none;text-autospace:
  none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:Symbol;
  mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:
  &quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Arial Unicode MS&quot;">способностью&nbsp; анализировать и использовать различные
  источники информации для проведения экономических расчетов оценки различных
  стратегий.</span><b><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
  Calibri"><o:p></o:p></span></b></p>
  </td>
  <td ="140" valign="top" style=": 108.8pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-pagination:none;mso-layout-grid-align:none;text-autospace:none"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
  &quot;Arial Unicode MS&quot;">&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td ="180" rowspan="3" valign="top" style=": 145.8pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt"><b><span style="font-size:12.0pt;line-height:
  107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Calibri;
  mso-bidi-font-style:italic">ИДК2. </span></b><b><span style="font-size:12.0pt;
  line-height:107%;font-family:&quot;Times New Roman&quot;,serif">ПК-4.</span></b><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">
  Выделяет приоритетные направления устойчивого развития
  социально-экономической системы, стимулирования экономического развития и
  роста в глобальной экономике<i><o:p></o:p></i></span></p>
  </td>
  <td ="211" valign="top" style=": 142.55pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal;mso-pagination:none;mso-layout-grid-align:none;
  text-autospace:none"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:&quot;Arial Unicode MS&quot;">Знать:<o:p></o:p></span></p>
  <p class="MsoListParagraphCxSpFirst" style="margin-top:0cm;margin-right:0cm;
  margin-bottom:0cm;margin-left:17.5pt;margin-bottom:.0001pt;mso-add-space:
  auto;text-align:justify;text-indent:-14.2pt;line-height:normal;mso-pagination:
  none;mso-list:l14 level1 lfo16;mso-layout-grid-align:none;text-autospace:
  none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:Symbol;
  mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:
  &quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Arial Unicode MS&quot;">тенденции
  развития экономики в современном мире и особенности их проявления в различных
  странах;</span><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri"><o:p></o:p></span></p>
  <p class="MsoListParagraphCxSpLast" style="margin-top:0cm;margin-right:0cm;
  margin-bottom:0cm;margin-left:17.5pt;margin-bottom:.0001pt;mso-add-space:
  auto;text-align:justify;text-indent:-14.2pt;line-height:normal;mso-pagination:
  none;mso-list:l14 level1 lfo16;mso-layout-grid-align:none;text-autospace:
  none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:Symbol;
  mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:
  &quot;Times New Roman&quot;,serif;mso-fareast-font-family:Calibri">перспективы и
  возможные последствия глобальных экономических процессов для России.<b><o:p></o:p></b></span></p>
  </td>
  <td ="140" valign="top" style=": 108.8pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormalCxSpFirst"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri">1.Домашнее задание (презентация по теме
  дисциплины).<o:p></o:p></span></p>
  <p class="MsoNormalCxSpMiddle" style="text-align:justify;text-autospace:ideograph-other"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri">2. Контрольная работа<o:p></o:p></span></p>
  <p class="MsoNormalCxSpMiddle" style="text-align:justify;text-autospace:ideograph-other"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:Calibri">&nbsp;</span></p>
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal;mso-pagination:none;mso-layout-grid-align:none;
  text-autospace:none"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:&quot;Arial Unicode MS&quot;">&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td ="211" valign="top" style=": 142.55pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal;mso-pagination:none;mso-layout-grid-align:none;
  text-autospace:none"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:&quot;Arial Unicode MS&quot;">Уметь:<o:p></o:p></span></p>
  <p class="MsoListParagraphCxSpFirst" style="margin-top:0cm;margin-right:0cm;
  margin-bottom:0cm;margin-left:17.5pt;margin-bottom:.0001pt;mso-add-space:
  auto;text-align:justify;text-indent:-14.2pt;line-height:normal;mso-pagination:
  none;mso-list:l14 level1 lfo16;mso-layout-grid-align:none;text-autospace:
  none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:Symbol;
  mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:
  &quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Arial Unicode MS&quot;">идентифицировать
  уровень и состояние развития национальных и региональных экономических
  систем;<o:p></o:p></span></p>
  <p class="MsoListParagraphCxSpLast" style="margin-top:0cm;margin-right:0cm;
  margin-bottom:0cm;margin-left:17.5pt;margin-bottom:.0001pt;mso-add-space:
  auto;text-align:justify;text-indent:-14.2pt;mso-pagination:none;mso-list:
  l14 level1 lfo16;tab-stops:list 15.7pt;mso-layout-grid-align:none;text-autospace:
  none"><!--[if !supportLists]--><span style="font-size:12.0pt;line-height:107%;
  font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;
  </span></span><!--[endif]--><span style="font-size:12.0pt;line-height:
  107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Calibri">ориентироваться
  в современных тенденциях развития мировой политики, глобальных политических и
  экономических процессах</span><span style="font-size:12.0pt;line-height:107%;
  font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Arial Unicode MS&quot;">.</span><b><span style="font-size:12.0pt;line-height:
  107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:Calibri"><o:p></o:p></span></b></p>
  </td>
  <td ="140" valign="top" style=": 108.8pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal;mso-pagination:none;mso-layout-grid-align:none;
  text-autospace:none"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:&quot;Arial Unicode MS&quot;">&nbsp;</span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:6;mso-yfti-lastrow:yes;height:162.65pt">
  <td ="211" style=": 142.55pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 162.65pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal;mso-pagination:none;mso-layout-grid-align:none;
  text-autospace:none"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:&quot;Arial Unicode MS&quot;">Владеть:<o:p></o:p></span></p>
  <p class="MsoListParagraphCxSpFirst" style="margin-top:0cm;margin-right:0cm;
  margin-bottom:0cm;margin-left:17.5pt;margin-bottom:.0001pt;mso-add-space:
  auto;text-align:justify;text-indent:-14.2pt;line-height:normal;mso-pagination:
  none;mso-list:l14 level1 lfo16;mso-layout-grid-align:none;text-autospace:
  none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:Symbol;
  mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:
  &quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Arial Unicode MS&quot;">терминологией
  в данной области знаний, <o:p></o:p></span></p>
  <p class="MsoListParagraphCxSpMiddle" style="margin-top:0cm;margin-right:0cm;
  margin-bottom:0cm;margin-left:17.5pt;margin-bottom:.0001pt;mso-add-space:
  auto;text-align:justify;text-indent:-14.2pt;line-height:normal;mso-pagination:
  none;mso-list:l14 level1 lfo16;mso-layout-grid-align:none;text-autospace:
  none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:Symbol;
  mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:
  &quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Arial Unicode MS&quot;">знанием
  источников информации о мировом хозяйстве, публикаций ООН и других
  международных организаций по вопросам состояния и перспектив развития мировой
  экономики,<o:p></o:p></span></p>
  <p class="MsoListParagraphCxSpLast" style="margin-top:0cm;margin-right:0cm;
  margin-bottom:0cm;margin-left:17.5pt;margin-bottom:.0001pt;mso-add-space:
  auto;text-align:justify;text-indent:-14.2pt;line-height:normal;mso-pagination:
  none;mso-list:l14 level1 lfo16;mso-layout-grid-align:none;text-autospace:
  none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:Symbol;
  mso-fareast-font-family:Symbol;mso-bidi-font-family:Symbol">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
  </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:
  &quot;Times New Roman&quot;,serif;mso-fareast-font-family:Calibri">навыками анализа
  современной экономической ситуации в мире.<b><o:p></o:p></b></span></p>
  </td>
  <td ="140" valign="top" style=": 108.8pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 162.65pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal;mso-pagination:none;mso-layout-grid-align:none;
  text-autospace:none"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:&quot;Arial Unicode MS&quot;">&nbsp;</span></p>
  </td>
 </tr>
</tbody></table>

</div><p class="MsoNormal" align="center" style="margin-bottom: 0.0001pt; text-indent: 35.45pt;"><a name="_Toc36301731"><span style="font-size:12.0pt;line-height:107%;font-family:
&quot;Times New Roman&quot;,serif">Виды работ по курсу «Мировая экономика» и критерии
оценки<o:p></o:p></span></a></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p><div align="center">

<table class="MsoNormalTable" border="1" cellspacing="0" cellpadding="0" style="border: none;">
 <tbody><tr>
  <td ="396" valign="top" style=": 297pt; border-: 1pt; border-color: windowtext; border-image: initial; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;tab-stops:list 62.45pt;text-autospace:ideograph-other"><span style="font-size:12.0pt;line-height:
  107%;font-family:&quot;Times New Roman&quot;,serif">Виды работы<o:p></o:p></span></p>
  </td>
  
  <td ="165" valign="top" style=": 124pt; border-top-: 1pt; border-right-: 1pt; border-bottom-: 1pt; border-top-color: windowtext; border-right-color: windowtext; border-bottom-color: windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;tab-stops:list 62.45pt;text-autospace:ideograph-other"><span style="font-size:12.0pt;line-height:
  107%;font-family:&quot;Times New Roman&quot;,serif">Максимальный балл<o:p></o:p></span></p>
  </td>
  
 </tr>
 <tr>
  <td ="396" valign="top" style=": 297pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;tab-stops:list 62.45pt;text-autospace:ideograph-other"><span style="font-size:12.0pt;line-height:
  107%;font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:bold">Посещение
  <o:p></o:p></span></p>
  </td>
  
  <td ="165" valign="top" style=": 124pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;tab-stops:list 62.45pt;text-autospace:ideograph-other"><span style="font-size:12.0pt;line-height:
  107%;font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:bold">8<o:p></o:p></span></p>
  </td>
  
 </tr>
 <tr>
  <td ="396" valign="top" style=": 297pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;tab-stops:list 62.45pt;text-autospace:ideograph-other"><span style="font-size:12.0pt;line-height:
  107%;font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:bold">Работа на
  семинарских занятиях<o:p></o:p></span></p>
  </td>
  
  <td ="165" valign="top" style=": 124pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;tab-stops:list 62.45pt;text-autospace:ideograph-other"><span style="font-size:12.0pt;line-height:
  107%;font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:bold">12<o:p></o:p></span></p>
  </td>
  
 </tr>
 <tr>
  <td ="396" valign="top" style=": 297pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;tab-stops:list 62.45pt;text-autospace:ideograph-other"><span style="font-size:12.0pt;line-height:
  107%;font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:bold">Контрольная
  работа<o:p></o:p></span></p>
  </td>
  
  <td ="165" valign="top" style=": 124pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;tab-stops:list 62.45pt;text-autospace:ideograph-other"><span style="font-size:12.0pt;line-height:
  107%;font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:bold">10 (2х5)<o:p></o:p></span></p>
  </td>
  
 </tr>
 <tr>
  <td ="396" valign="top" style=": 297pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;tab-stops:list 62.45pt;text-autospace:ideograph-other"><span style="font-size:12.0pt;line-height:
  107%;font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:bold">Домашнее
  задание (презентация и доклад)<o:p></o:p></span></p>
  </td>
  
  <td ="165" valign="top" style=": 124pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;tab-stops:list 62.45pt;text-autospace:ideograph-other"><span style="font-size:12.0pt;line-height:
  107%;font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:bold">20<o:p></o:p></span></p>
  </td>
  
 </tr>
 <tr>
  <td ="396" valign="top" style=": 297pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;tab-stops:list 62.45pt;text-autospace:ideograph-other"><span style="font-size:12.0pt;line-height:
  107%;font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:bold">Экзамен <o:p></o:p></span></p>
  </td>
  
  <td ="165" valign="top" style=": 124pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;tab-stops:list 62.45pt;text-autospace:ideograph-other"><span style="font-size:12.0pt;line-height:
  107%;font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:bold">50<o:p></o:p></span></p>
  </td>
  
 </tr>
 <tr>
  <td ="396" valign="top" style=": 297pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;tab-stops:list 62.45pt;text-autospace:ideograph-other"><span style="font-size:12.0pt;line-height:
  107%;font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:bold">Итого <o:p></o:p></span></p>
  </td>
  
  <td ="165" valign="top" style=": 124pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;tab-stops:list 62.45pt;text-autospace:ideograph-other"><span style="font-size:12.0pt;line-height:
  107%;font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:bold">100<o:p></o:p></span></p>
  </td>
  
 </tr>
</tbody></table>

</div><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;line-height:normal;mso-pagination:none;tab-stops:2.0cm;mso-layout-grid-align:
none;text-autospace:none"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;tab-stops:
82.95pt"><span style="font-size:12.0pt;
line-height:107%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p><h1 style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:42.0pt;
margin-bottom:.0001pt;text-indent:-6.55pt;mso-list:l10 level2 lfo6"><a name="_Toc36301732"><!--[if !supportLists]--><span style="font-size:12.0pt">13.2.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt">Домашнее задание</span></a><span style="font-size:12.0pt"> <o:p></o:p></span></h1><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-indent:
35.45pt;mso-pagination:no-line-numbers;mso-layout-grid-align:none;text-autospace:
none"><b><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">(проводится&nbsp; в форме презентации и доклада)<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;mso-pagination:no-line-numbers;mso-layout-grid-align:
none;text-autospace:none"><b><span style="font-size:12.0pt;line-height:
107%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;mso-pagination:no-line-numbers;mso-layout-grid-align:
none;text-autospace:none"><b><span style="font-size:12.0pt;line-height:
107%;font-family:&quot;Times New Roman&quot;,serif">Темы презентаций результатов исследовательской
деятельности<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;tab-stops:25.0pt"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-language:KO">по дисциплине&nbsp;
Мировая экономика <o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:36.0pt;line-height:normal;mso-pagination:none;mso-list:l8 level1 lfo22;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">1.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Мировые
кризисы: понятие, сущность;<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:36.0pt;line-height:normal;mso-list:l8 level1 lfo22;tab-stops:list 36.0pt left 2.0cm;
text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">2.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Влияние
национальных и международных институтов на преодоление последствий мирового
финансово-экономического кризиса 2008- 2010 гг.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:36.0pt;line-height:normal;mso-pagination:none;mso-list:l8 level1 lfo22;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">3.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Меры
стран по противодействию кризисным явлениям.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:36.0pt;line-height:normal;mso-pagination:none;mso-list:l8 level1 lfo22;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">4.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Глобализация:
проявление в разных странах;<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:36.0pt;line-height:normal;mso-list:l8 level1 lfo22;tab-stops:list 36.0pt left 2.0cm;
text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">5.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Влияние
наднациональных институтов регулирования на процессы глобализации и
регионализации.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:36.0pt;line-height:normal;mso-pagination:none;mso-list:l8 level1 lfo22;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">6.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Постиндустриализация
экономики&nbsp; и ее последствия;<o:p></o:p></span></p><p class="MsoListParagraphCxSpFirst" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:36.0pt;line-height:normal;
mso-list:l7 level1 lfo26;tab-stops:2.0cm;text-autospace:none"><!--[if !supportLists]--><span style="font-size:
12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">7<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Региональные
экономические группировки. <o:p></o:p></span></p><p class="MsoListParagraphCxSpLast" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:36.0pt;line-height:normal;
mso-list:l7 level1 lfo26;tab-stops:2.0cm;text-autospace:none"><!--[if !supportLists]--><span style="font-size:
12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">8<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Влияние
наднациональных институтов регулирования на деятельность ТНК<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:36.0pt;line-height:normal;mso-list:l7 level1 lfo26;tab-stops:2.0cm;
text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">9<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Влияние
наднациональных институтов регулирования на процессы использования природных
ресурсов<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:36.0pt;line-height:normal;mso-pagination:none;mso-list:l7 level1 lfo26;
tab-stops:2.0cm;mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:
12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">10<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">ТНК
и инновационное развитие<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:36.0pt;line-height:normal;mso-list:l7 level1 lfo26;tab-stops:2.0cm;
text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">11<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Влияние
наднациональных институтов регулирования на процессы использования природных
ресурсов<o:p></o:p></span></p><p class="MsoListParagraph" style="margin:0cm;margin-bottom:.0001pt;mso-add-space:
auto;text-align:justify;text-indent:36.0pt;line-height:normal;mso-list:l7 level1 lfo26;
tab-stops:2.0cm;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">12<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Влияние
наднациональных институтов регулирования на мировую финансовую стабильность.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:36.0pt;line-height:normal;mso-pagination:none;mso-list:l7 level1 lfo26;
tab-stops:2.0cm;mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:
12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">13<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Место
и роль государства в экономике развитых стран<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:36.0pt;line-height:normal;mso-pagination:none;mso-list:l7 level1 lfo26;
tab-stops:2.0cm;mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:
12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">14<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Перспективы
и риски углеводородной экономики.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:36.0pt;line-height:normal;mso-pagination:none;mso-list:l7 level1 lfo26;
tab-stops:2.0cm;mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:
12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">15<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Альтернативная
энергетика: панацея мировой энергетики?<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:36.0pt;line-height:normal;mso-pagination:none;mso-list:l7 level1 lfo26;
tab-stops:2.0cm;mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:
12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">16<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Особенности
экономики стран ЕС;<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:36.0pt;line-height:normal;mso-pagination:none;mso-list:l7 level1 lfo26;
tab-stops:2.0cm;mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:
12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">17<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Особенности
современного состояния экономики США;<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:36.0pt;line-height:normal;mso-pagination:none;mso-list:l7 level1 lfo26;
tab-stops:2.0cm;mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:
12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">18<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Особенности
современного состояния экономики Японии<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:36.0pt;line-height:normal;mso-pagination:none;mso-list:l7 level1 lfo26;
tab-stops:2.0cm;mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:
12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">19<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Особенности
экономики новых индустриальных стран<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:36.0pt;line-height:normal;mso-pagination:none;mso-list:l7 level1 lfo26;
tab-stops:2.0cm;mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:
12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">20<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Место
и роль государства в экономике развитых стран <o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:36.0pt;line-height:normal;mso-pagination:none;mso-list:l7 level1 lfo26;
tab-stops:2.0cm;mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:
12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">21<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Место
и роль государства в экономике развивающихся стран и стран переходной
экономики.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:36.0pt;line-height:normal;mso-pagination:none;mso-list:l7 level1 lfo26;
tab-stops:2.0cm;mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:
12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">22<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Особенности
современного состояния экономики БРИКС;<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:36.0pt;line-height:normal;mso-pagination:none;mso-list:l7 level1 lfo26;
tab-stops:2.0cm;mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:
12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">23<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Особенности
современного состояния экономики Китая.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:36.0pt;line-height:normal;mso-pagination:none;mso-list:l7 level1 lfo26;
tab-stops:2.0cm;mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:
12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">24<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Arial Unicode MS&quot;">Энергетическая и сырьевая проблемы.
<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:36.0pt;line-height:normal;mso-pagination:none;mso-list:l7 level1 lfo26;
tab-stops:2.0cm;mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:
12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">25<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Arial Unicode MS&quot;">Концепция устойчивого развития ООН.
<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:36.0pt;line-height:normal;mso-pagination:none;mso-list:l7 level1 lfo26;
tab-stops:2.0cm;mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:
12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">26<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Arial Unicode MS&quot;">Проблема освоения и использования
ресурсов мирового океана и космоса. <o:p></o:p></span></p><p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:36.0pt;margin-bottom:.0001pt;text-align:justify;mso-pagination:
none;mso-layout-grid-align:none;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Arial Unicode MS&quot;">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;mso-pagination:none;mso-layout-grid-align:none;
text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Требования
к презентации:<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l3 level1 lfo24;
tab-stops:list 36.0pt left 49.65pt;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">10
слайдов + доклад на 10 минут.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l3 level1 lfo24;
tab-stops:list 36.0pt left 49.65pt;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Первый
слайд – название, автор, группа;<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l3 level1 lfo24;
tab-stops:list 36.0pt left 49.65pt;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Последний
слайд - источники.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l3 level1 lfo24;
tab-stops:list 36.0pt left 49.65pt;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">В
презентации должны содержаться:<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l3 level1 lfo24;
tab-stops:list 36.0pt left 49.65pt;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">цель,
задачи, проблема, выводы.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l3 level1 lfo24;
tab-stops:list 36.0pt left 49.65pt;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">В
презентации НЕ ДОЛЖНО быть много текста.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l3 level1 lfo24;
tab-stops:list 36.0pt left 49.65pt;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Должны
преобладать графики, таблицы, иллюстрации и т.п.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l3 level1 lfo24;
tab-stops:list 36.0pt left 49.65pt;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">-<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Работа
должна опираться на современный статистический и аналитический материал<o:p></o:p></span></p><p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:18.0pt;margin-bottom:.0001pt;text-align:justify;mso-pagination:
none;mso-layout-grid-align:none;text-autospace:none"><b><span style="font-size:
12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></b></p><p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:18.0pt;margin-bottom:.0001pt;text-align:justify;text-indent:17.45pt;
mso-pagination:none;mso-layout-grid-align:none;text-autospace:none"><b><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Критерии
оценки домашнего задания:<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:36.0pt;mso-pagination:none;tab-stops:114.75pt;mso-layout-grid-align:
none;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p><table class="MsoNormalTable" border="1" cellspacing="0" cellpadding="0" style="margin-left: 40.85pt; border: none;">
 <tbody><tr style="mso-yfti-irow:0;mso-yfti-firstrow:yes;height:13.4pt">
  <td ="178" valign="top" style=": 133.5pt; border-: 1pt; border-color: windowtext; border-image: initial; padding: 0cm 5.4pt; height: 13.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Балл
  <o:p></o:p></span></p>
  </td>
  
  <td ="406" valign="top" style=": 304.25pt; border-top-: 1pt; border-right-: 1pt; border-bottom-: 1pt; border-top-color: windowtext; border-right-color: windowtext; border-bottom-color: windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt; height: 13.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Условия<o:p></o:p></span></p>
  </td>
  
 </tr>
 <tr style="mso-yfti-irow:1;height:41.0pt">
  <td ="178" valign="top" style=": 133.5pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 41pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">20
  <o:p></o:p></span></p>
  </td>
  
  <td ="406" valign="top" style=": 304.25pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 41pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Оригинальное
  содержание<o:p></o:p></span></p>
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Актуальная
  статистика<o:p></o:p></span></p>
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Самостоятельное
  изложение<o:p></o:p></span></p>
  </td>
  
 </tr>
 <tr style="mso-yfti-irow:2;height:13.4pt">
  <td ="178" valign="top" style=": 133.5pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 13.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">16<o:p></o:p></span></p>
  </td>
  
  <td ="406" valign="top" style=": 304.25pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 13.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Несоблюдение
  одного из условий<o:p></o:p></span></p>
  </td>
  
 </tr>
 <tr style="mso-yfti-irow:3;height:13.4pt">
  <td ="178" valign="top" style=": 133.5pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 13.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">12<o:p></o:p></span></p>
  </td>
  
  <td ="406" valign="top" style=": 304.25pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 13.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Несоблюдение
  двух условий<o:p></o:p></span></p>
  </td>
  
 </tr>
 <tr style="mso-yfti-irow:4;height:13.4pt">
  <td ="178" valign="top" style=": 133.5pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 13.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">6<o:p></o:p></span></p>
  </td>
  
  <td ="406" valign="top" style=": 304.25pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 13.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Несоблюдение
  трех условий<o:p></o:p></span></p>
  </td>
  
 </tr>
 <tr style="mso-yfti-irow:5;mso-yfti-lastrow:yes;height:14.15pt">
  <td ="178" valign="top" style=": 133.5pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 14.15pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">0<o:p></o:p></span></p>
  </td>
  
  <td ="406" valign="top" style=": 304.25pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 14.15pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Невыполнение
  домашнего задания<o:p></o:p></span></p>
  </td>
  
 </tr>
</tbody></table><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:36.0pt;mso-pagination:none;tab-stops:114.75pt;mso-layout-grid-align:
none;text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;text-autospace:ideograph-other"><span style="font-size:12.0pt;line-height:
107%;font-family:&quot;Times New Roman&quot;,serif">Оценка «отлично» (20 баллов)
выставляется студенту, если студент выполнил все требования к презентации и
презентация отражала высокий уровень самостоятельного экономического мышления и
содержала оригинальные подходы к анализируемой проблеме.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;text-autospace:ideograph-other"><span style="font-size:12.0pt;line-height:
107%;font-family:&quot;Times New Roman&quot;,serif">Оценка «хорошо» (16 баллов)
выставляется студенту, если что-то из предлагаемых требований не соблюдено и
презентация не отличается оригинальностью<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;text-autospace:ideograph-other"><span style="font-size:12.0pt;line-height:
107%;font-family:&quot;Times New Roman&quot;,serif">Оценка «удовлетворительно» (12
баллов) выставляется студенту, если он в целом представляет себе позицию по
обсуждаемой проблеме, но использовал при ее подготовке неактуальные данные, а
презентация носит вторичный характер.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;text-autospace:ideograph-other"><span style="font-size:12.0pt;line-height:
107%;font-family:&quot;Times New Roman&quot;,serif">Оценка 6 баллов выставляется
студенту, если он формально подготовил задание, но оно не отвечает ни одному из
требований.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;text-autospace:ideograph-other"><span style="font-size:12.0pt;line-height:
107%;font-family:&quot;Times New Roman&quot;,serif">Оценка «неудовлетворительно» (0
баллов) выставляется студенту, если он не подготовил презентацию.<o:p></o:p></span></p><p class="MsoNormal"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:RU">&nbsp;</span></p><h1 style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:42.0pt;
margin-bottom:.0001pt;text-indent:-6.55pt;mso-list:l10 level2 lfo6"><!--[if !supportLists]--><span style="font-size:
12.0pt">13.3.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt">Перечень вопросов
для подготовки к контрольной работе</span><span style="font-size:12.0pt"><o:p></o:p></span></h1><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;text-autospace:none"><b><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;text-autospace:none"><b><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Вопросы
к контрольной работе 1:<o:p></o:p></span></b></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l5 level1 lfo27;tab-stops:2.0cm;
text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">1.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Альтернативная
энергетика: панацея мировой энергетики?<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l5 level1 lfo27;tab-stops:2.0cm;
text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">2.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Влияние
международных наднациональных институтов регулирования на процессы
регионализации<o:p></o:p></span></p><p class="MsoListParagraph" style="margin:0cm;margin-bottom:.0001pt;mso-add-space:
auto;text-align:justify;text-indent:35.45pt;line-height:normal;mso-pagination:
none;mso-list:l5 level1 lfo27;tab-stops:2.0cm;mso-layout-grid-align:none;
text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">3.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Arial Unicode MS&quot;">Влияние международных
наднациональных институтов регулирования на деятельность ТНК<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l5 level1 lfo27;tab-stops:2.0cm;
text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">4.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Влияние
наднациональных институтов регулирования на деятельность ТНК<o:p></o:p></span></p><p class="MsoListParagraph" style="margin:0cm;margin-bottom:.0001pt;mso-add-space:
auto;text-align:justify;text-indent:35.45pt;line-height:normal;mso-list:l5 level1 lfo27;
tab-stops:2.0cm;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">5.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Влияние
наднациональных институтов регулирования на мировую финансовую стабильность.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l5 level1 lfo27;tab-stops:2.0cm;
text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">6.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Влияние
наднациональных институтов регулирования на процессы глобализации и
регионализации.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l5 level1 lfo27;
tab-stops:2.0cm;mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">7.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Влияние
наднациональных институтов регулирования на процессы использования природных
ресурсов</span><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Arial Unicode MS&quot;"><o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l5 level1 lfo27;tab-stops:2.0cm;
text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">8.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Влияние
национальных и международных институтов на преодоление последствий мирового
финансово-экономического кризиса 2008- 2010 гг.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l5 level1 lfo27;tab-stops:2.0cm;
text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
mso-bidi-font-weight:bold">9.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-bidi-font-weight:bold">Всемирное хозяйство, его сущность, основные этапы
формирования и развития<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l5 level1 lfo27;tab-stops:2.0cm;
text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">10.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Демографические
ресурсы современной мировой экономики и международная миграция населения и
рабочей силы<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l5 level1 lfo27;
tab-stops:2.0cm;mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">11.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Arial Unicode MS&quot;">Какие Вы знаете направления решения
проблемы дефицита природных ресурсов в современной мировой экономике?<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l5 level1 lfo27;
tab-stops:2.0cm;mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">12.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Arial Unicode MS&quot;">Какие процессы характеризует
«голландская болезнь»?<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l5 level1 lfo27;
tab-stops:2.0cm;mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">13.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Arial Unicode MS&quot;">Какие страны являются лидерами по
добыче, экспорту и потреблению основных энергоресурсов?<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l5 level1 lfo27;
tab-stops:2.0cm;mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">14.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Arial Unicode MS&quot;">Какие страны являются лидерами по
развитию альтернативной энергетики?<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l5 level1 lfo27;
tab-stops:2.0cm;mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">15.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Arial Unicode MS&quot;">Каковы современные тенденции добычи
и потребления основных минерально-сырьевых ресурсов?<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l5 level1 lfo27;tab-stops:2.0cm;
text-autospace:none"><!--[if !supportLists]--><span lang="EN-US" style="font-size:
12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
mso-ansi-language:EN-US">16.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Международная</span><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-ansi-language:
EN-US"> </span><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">экономическая</span><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-ansi-language:
EN-US"> </span><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">интеграция</span><span lang="EN-US" style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-ansi-language:EN-US"><o:p></o:p></span></p><p class="MsoListParagraphCxSpFirst" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;line-height:normal;
mso-list:l5 level1 lfo27;tab-stops:2.0cm;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">17.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Международные
наднациональные институты и&nbsp;
регулирование развития научных и информационных ресурсов современного
мирового хозяйства.<o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;line-height:normal;
mso-list:l5 level1 lfo27;tab-stops:2.0cm;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">18.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Международные
наднациональные институты и регулирование процессов глобализации.<o:p></o:p></span></p><p class="MsoListParagraphCxSpMiddle" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;line-height:normal;
mso-list:l5 level1 lfo27;tab-stops:2.0cm;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">19.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Место
и роль международных наднациональных институтов регулирования в современных МЭО<o:p></o:p></span></p><p class="MsoListParagraphCxSpLast" style="margin:0cm;margin-bottom:.0001pt;
mso-add-space:auto;text-align:justify;text-indent:35.45pt;line-height:normal;
mso-list:l5 level1 lfo27;tab-stops:2.0cm;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">20.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Место
и роль международных наднациональных институтов регулирования на процессы
функционирования современной мировой финансовой инфраструктуры.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l5 level1 lfo27;tab-stops:2.0cm;
text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">21.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Мировая
экономика: понятие и сущность<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l5 level1 lfo27;tab-stops:2.0cm;
text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">22.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Научные
и информационные ресурсы мира<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l5 level1 lfo27;tab-stops:2.0cm;
text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">23.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Основные
тенденции развития современной мировой экономики<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l5 level1 lfo27;tab-stops:2.0cm;
text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">24.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Переход
к постиндустриальному обществу<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l5 level1 lfo27;tab-stops:2.0cm;
text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">25.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Перспективы
и риски углеводородной экономики<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l5 level1 lfo27;tab-stops:2.0cm;
text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">26.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Попробуем
разобраться, существует ли ресурсное проклятие или голландская болезнь?<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l5 level1 lfo27;tab-stops:2.0cm;
text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">27.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Природные
ресурсы современной мировой экономики<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l5 level1 lfo27;tab-stops:2.0cm;
text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">28.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Ресурсный
потенциал мирового хозяйства<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l5 level1 lfo27;tab-stops:2.0cm;
text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">29.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Роль
международных и транснациональных корпораций в современной мировой экономике.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l5 level1 lfo27;tab-stops:2.0cm;
text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">30.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Становление
и развитие всемирного хозяйства.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l5 level1 lfo27;tab-stops:2.0cm;
text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">31.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Финансовые
ресурсы современной мировой экономики и международные финансовые отношения.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l5 level1 lfo27;
tab-stops:2.0cm;mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">32.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Arial Unicode MS&quot;">Что такое «проклятие природных ресурсов»?<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l5 level1 lfo27;tab-stops:2.0cm;
text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">33.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Arial Unicode MS&quot;">Что такое «сланцевая революция»?</span><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif"> <o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l5 level1 lfo27;tab-stops:2.0cm;
text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">34.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Экономическая
и политическая глобализация мирового хозяйства.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l5 level1 lfo27;tab-stops:2.0cm;
text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
mso-bidi-font-weight:bold">35.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-bidi-font-weight:
bold">Этапы становления и развития современного мирового хозяйства<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;text-autospace:none"><b><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;text-autospace:none"><b><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Вопросы
к контрольной работе 2:</span></b><span style="font-size:12.0pt;line-height:
107%;font-family:&quot;Times New Roman&quot;,serif"> <o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l26 level1 lfo23;tab-stops:
49.65pt;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">1<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Роль
развитых стран с рыночной экономикой в мировом хозяйстве <o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l25 level1 lfo28;tab-stops:
49.65pt;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">2.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Особенности
экономики развитых стран<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l25 level1 lfo28;tab-stops:
49.65pt;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">3.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Место
и роль государства в экономике развитых стран<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-list:l25 level1 lfo28;tab-stops:
49.65pt;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;">4.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Современное
состояние экономик промышленно развитых стран.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l26 level1 lfo23;
tab-stops:49.65pt;mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span lang="EN-US" style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;;mso-ansi-language:EN-US">2<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span lang="EN-US" style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Arial Unicode MS&quot;;
mso-ansi-language:EN-US">Классификация развивающихся стран<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l26 level1 lfo23;
tab-stops:49.65pt;mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span lang="EN-US" style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;;mso-ansi-language:EN-US">3<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span lang="EN-US" style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Arial Unicode MS&quot;;
mso-ansi-language:EN-US">Основные черты экономики НИС<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l26 level1 lfo23;
tab-stops:49.65pt;mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span lang="EN-US" style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;;mso-ansi-language:EN-US">4<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span lang="EN-US" style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Arial Unicode MS&quot;;
mso-ansi-language:EN-US">Особенности развития Китая и Индии<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l4 level1 lfo7;
tab-stops:49.65pt;mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">1.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Место
и роль государства в экономике развитых стран </span><span style="font-size:
12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Arial Unicode MS&quot;"><o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l4 level1 lfo7;
tab-stops:49.65pt;mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">2.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Место
и роль государства в экономике развивающихся и переходных экономик.</span><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Arial Unicode MS&quot;"><o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l4 level1 lfo7;
tab-stops:49.65pt;mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">3.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Arial Unicode MS&quot;">Концепция устойчивого развития ООН.
<o:p></o:p></span></p><p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:71.45pt;margin-bottom:.0001pt;text-align:justify;mso-pagination:
none;mso-layout-grid-align:none;text-autospace:none"><span style="font-size:
12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Arial Unicode MS&quot;">&nbsp;</span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;text-autospace:ideograph-other"><b><span style="font-size:12.0pt;line-height:
107%;font-family:&quot;Times New Roman&quot;,serif">Контрольная работа <o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;text-autospace:ideograph-other"><b><span style="font-size:12.0pt;line-height:
107%;font-family:&quot;Times New Roman&quot;,serif">Макет<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;text-autospace:ideograph-other"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Группа
______ <o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;text-autospace:ideograph-other"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Фамилия
_______________________________ <o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;mso-pagination:none;mso-layout-grid-align:none;
text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:
&quot;Times New Roman&quot;,serif">Вариант 1<o:p></o:p></span></p><table class="MsoNormalTable" border="1" cellspacing="0" cellpadding="0" ="0" style=": 471.5pt; border: none;">
 <tbody><tr style="mso-yfti-irow:0;mso-yfti-firstrow:yes;height:18.7pt">
  <td ="126" valign="top" style=": 94.3pt; border-: 1pt; border-color: windowtext; border-image: initial; padding: 0cm 5.4pt; height: 18.7pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;text-indent:35.45pt;mso-pagination:none;mso-layout-grid-align:none;
  text-autospace:none"><span style="font-size:12.0pt;line-height:107%;
  font-family:&quot;Times New Roman&quot;,serif">1</span><span style="font-size:12.0pt;
  line-height:107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-language:
  EN-GB"><o:p></o:p></span></p>
  </td>
  <td ="126" valign="top" style=": 94.3pt; border-top-: 1pt; border-right-: 1pt; border-bottom-: 1pt; border-top-color: windowtext; border-right-color: windowtext; border-bottom-color: windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt; height: 18.7pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;text-indent:35.45pt;mso-pagination:none;mso-layout-grid-align:none;
  text-autospace:none"><span style="font-size:12.0pt;line-height:107%;
  font-family:&quot;Times New Roman&quot;,serif">2</span><span style="font-size:12.0pt;
  line-height:107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-language:
  EN-GB"><o:p></o:p></span></p>
  </td>
  <td ="126" valign="top" style=": 94.3pt; border-top-: 1pt; border-right-: 1pt; border-bottom-: 1pt; border-top-color: windowtext; border-right-color: windowtext; border-bottom-color: windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt; height: 18.7pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;text-indent:35.45pt;mso-pagination:none;mso-layout-grid-align:none;
  text-autospace:none"><span style="font-size:12.0pt;line-height:107%;
  font-family:&quot;Times New Roman&quot;,serif">3</span><span style="font-size:12.0pt;
  line-height:107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-language:
  EN-GB"><o:p></o:p></span></p>
  </td>
  <td ="126" valign="top" style=": 94.3pt; border-top-: 1pt; border-right-: 1pt; border-bottom-: 1pt; border-top-color: windowtext; border-right-color: windowtext; border-bottom-color: windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt; height: 18.7pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;text-indent:35.45pt;mso-pagination:none;mso-layout-grid-align:none;
  text-autospace:none"><span style="font-size:12.0pt;line-height:107%;
  font-family:&quot;Times New Roman&quot;,serif">4</span><span style="font-size:12.0pt;
  line-height:107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-language:
  EN-GB"><o:p></o:p></span></p>
  </td>
  <td ="126" valign="top" style=": 94.3pt; border-top-: 1pt; border-right-: 1pt; border-bottom-: 1pt; border-top-color: windowtext; border-right-color: windowtext; border-bottom-color: windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt; height: 18.7pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;text-indent:35.45pt;mso-pagination:none;mso-layout-grid-align:none;
  text-autospace:none"><span style="font-size:12.0pt;line-height:107%;
  font-family:&quot;Times New Roman&quot;,serif">5</span><span style="font-size:12.0pt;
  line-height:107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-language:
  EN-GB"><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style="mso-yfti-irow:1;mso-yfti-lastrow:yes;height:19.4pt">
  <td ="126" valign="top" style=": 94.3pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 19.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;text-indent:35.45pt;mso-pagination:none;mso-layout-grid-align:none;
  text-autospace:none"><span style="font-size:12.0pt;line-height:107%;
  font-family:&quot;Times New Roman&quot;,serif;mso-fareast-language:EN-GB">&nbsp;</span></p>
  </td>
  <td ="126" valign="top" style=": 94.3pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 19.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;text-indent:35.45pt;mso-pagination:none;mso-layout-grid-align:none;
  text-autospace:none"><span style="font-size:12.0pt;line-height:107%;
  font-family:&quot;Times New Roman&quot;,serif;mso-fareast-language:EN-GB">&nbsp;</span></p>
  </td>
  <td ="126" valign="top" style=": 94.3pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 19.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;text-indent:35.45pt;mso-pagination:none;mso-layout-grid-align:none;
  text-autospace:none"><span style="font-size:12.0pt;line-height:107%;
  font-family:&quot;Times New Roman&quot;,serif;mso-fareast-language:EN-GB">&nbsp;</span></p>
  </td>
  <td ="126" valign="top" style=": 94.3pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 19.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;text-indent:35.45pt;mso-pagination:none;mso-layout-grid-align:none;
  text-autospace:none"><span style="font-size:12.0pt;line-height:107%;
  font-family:&quot;Times New Roman&quot;,serif;mso-fareast-language:EN-GB">&nbsp;</span></p>
  </td>
  <td ="126" valign="top" style=": 94.3pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt; height: 19.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;text-indent:35.45pt;mso-pagination:none;mso-layout-grid-align:none;
  text-autospace:none"><span style="font-size:12.0pt;line-height:107%;
  font-family:&quot;Times New Roman&quot;,serif;mso-fareast-language:EN-GB">&nbsp;</span></p>
  </td>
 </tr>
</tbody></table><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;mso-pagination:none;mso-layout-grid-align:none;
text-autospace:none"><span style="font-size:12.0pt;line-height:107%;font-family:
&quot;Times New Roman&quot;,serif;mso-fareast-language:EN-GB">&nbsp;</span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l1 level1 lfo21;
mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">1.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-bidi-font-weight:bold">Основные тенденции развития современной мировой
экономики: </span><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif"><o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l17 level1 lfo25;
mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">a.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">миграция
населения<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l17 level1 lfo25;
mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">b.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">транснационализация
и глобализация экономики<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l17 level1 lfo25;
mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">c.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">обострение
религиозного противостояния<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l17 level1 lfo25;
mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">d.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">информатизация
экономики.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l17 level1 lfo25;
mso-layout-grid-align:none;text-autospace:none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;">e.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">углубление
разделения труда<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;text-autospace:none"><b><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;text-autospace:none"><b><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;text-autospace:none"><b><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Критерии
оценки контрольной работы:<o:p></o:p></span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;text-autospace:none"><span style="font-size:12.0pt;
line-height:107%;font-family:&quot;Times New Roman&quot;,serif">Контрольная работа
предполагает решение теста, состоящего из 5 вопросов. Максимальный балл,
который может набрать обучающийся при решении контрольной работы – 5. Каждый
правильный ответ оценивается в 1 балл, неправильный – 0 баллов.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:normal;tab-stops:2.0cm"><i><span style="font-size:12.0pt;font-family:
&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;color:#00B050;
mso-fareast-language:RU">&nbsp;</span></i></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:normal"><b><span style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
mso-fareast-language:RU">&nbsp;</span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:normal"><b><span style="font-size:12.0pt;
font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
mso-fareast-language:RU">&nbsp;</span></b></p><h1 style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;margin-left:42.0pt;
margin-bottom:.0001pt;text-indent:-6.55pt;mso-list:l10 level2 lfo6"><a name="_Toc36301730"><!--[if !supportLists]--><span style="font-size:12.0pt">13.4.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span><!--[endif]--><span style="font-size:12.0pt">&nbsp;Перечень вопросов к экзамену</span></a><span style="font-size:12.0pt"><o:p></o:p></span></h1><p class="MsoNormal" style="margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:35.45pt;margin-bottom:.0001pt;text-align:justify;line-height:normal;
mso-pagination:none;tab-stops:49.65pt;mso-layout-grid-align:none;text-autospace:
none"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">&nbsp;</span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 49.65pt;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">1.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Агропромышленный
комплекс, направления развития<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 49.65pt;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">2.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">&nbsp;Состояние интеграционных процессов в рамках
СНГ<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 49.65pt;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">3.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Глобальные проблемы
мировой экономики.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 49.65pt;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">4.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Группа Всемирного
банка в современных МЭО.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 49.65pt;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">5.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Какими
экономическими показателями характеризуется переход от индустриального общества
к постиндустриальному?<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 49.65pt;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">6.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Концепция
стратегии устойчивого развития<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 49.65pt;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">7.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Критерии
классификации стран по экономическому потенциалу и уровню
социально-экономического развития.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 49.65pt;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">8.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Международная
миграция рабочей силы: понятие и причины.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 49.65pt;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">9.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Международная
экономическая интеграция: формы, преимущества, недостатки.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">10.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Международные
финансовые отношения. <o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">11.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Международные
экономические организации: классификация и основные направления деятельности.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">12.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Международный
инвестиционный процесс: прямые и портфельные иностранные инвестиции.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">13.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Международный
кредит: сущность и формы. <o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">14.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Место и роль
международных экономических организаций – Всемирного банка, Международного
валютного фонда, Европейского банка реконструкции и развития, Парижского и
Лондонского клубов кредиторов, ОЭСР в регулировании глобальных процессов в
современном мире.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">15.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Многостороннее
международное сотрудничество <o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">16.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Наиболее развитые
мировые экономические группировки<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">17.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Направления
изменения структуры использования основных энергетических ресурсов.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">18.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Научные ресурсы
мировой экономики<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">19.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Место и роль новых
индустриальных стран в современном мировом хозяйстве<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">20.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Место и роль
наименее развитых стран в современном мировом хозяйстве<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">21.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Особенности
использования запасов металлических руд, земельных, водных, лесных ресурсов<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">22.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Особенности прямых
иностранных инвестиций в развитых, развивающихся странах и странах переходной
экономики.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">23.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Особенности
развития экономики Китая.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">24.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Особенности
размещения основных минеральных ресурсов в мире.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">25.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Оффшорные зоны и
налоговые гавани в мировой экономике.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">26.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Показатели степени
участия государств в международных экономических отношениях<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">27.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Положительные и
отрицательные последствия международной экономической интеграции.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">28.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Положительные и
отрицательные факторы влияния экономической глобализации на мировую экономику.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">29.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Понятие
неравномерности развития мировой экономики и разрыва в уровнях
социально-экономического положения стран.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">30.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Проблема внешнего
долга и пути ее урегулирования.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">31.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Проблемы перехода
бывших социалистических стран к рыночной системе хозяйства<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">32.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Проблемы
распределения и использования трудовых ресурсов в мире.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">33.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Роль развивающихся
государств во всемирном хозяйстве<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">34.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Роль развитых
стран в мировой экономике<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">35.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Социально-экономическая
модель США<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">36.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Социально-экономическая
модель Западной Европы<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">37.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Социально-экономическая
модель Японии<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">38.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Социально-экономические
последствия международной миграции рабочей силы. <o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">39.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Структура ООН
Главные органы и специализированные учреждения.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">40.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Сущность мировой
экономики.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">41.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Транснациональные
корпорации в современном мире.<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">42.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Функционирование
основных интеграционных объединений – ЕС, НАФТА, АСЕАН, МЕРКОСУР, СНГ<o:p></o:p></span></p><p class="MsoNormal" style="margin:0cm;margin-bottom:.0001pt;text-align:justify;
text-indent:35.45pt;line-height:normal;mso-pagination:none;mso-list:l9 level1 lfo20;
tab-stops:list 36.0pt left 2.0cm;mso-layout-grid-align:none;text-autospace:
none"><!--[if !supportLists]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;">43.<span style="font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><!--[endif]--><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">Экономическая
интеграция в СНГ. Основные интеграционные объединения и интеграционная политика
РФ в странах содружества.<o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:normal"><i><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:#00B050;mso-fareast-language:
RU">&nbsp;</span></i></p><p class="MsoNormal" align="center" style="margin-bottom: 0.0001pt; line-height: normal;"><b><span style="font-size:12.0pt;font-family:
&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:
RU">Показатели оценивания результатов обучения<o:p></o:p></span></b></p><p class="MsoNormal" align="center" style="margin-bottom: 0.0001pt; line-height: normal;"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;;mso-fareast-language:RU">&nbsp;</span></p><div align="center">

<table class="MsoNormalTable" border="1" cellspacing="0" cellpadding="0" ="0" style="border: none;">
 <tbody><tr>
  <td ="178" style=": 81.55pt; border-: 1pt; border-color: windowtext; border-image: initial; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal"><span style="font-size:12.0pt;
  font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
  mso-fareast-language:RU">Шкала оценивания<o:p></o:p></span></p>
  </td>
  <td ="503" valign="top" style=": 400.4pt; border-top-: 1pt; border-right-: 1pt; border-bottom-: 1pt; border-top-color: windowtext; border-right-color: windowtext; border-bottom-color: windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal"><span style="font-size:12.0pt;
  font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
  mso-fareast-language:RU">Критерии оценивания<o:p></o:p></span></p>
  </td>
 </tr>
 <tr>
  <td ="178" style=": 81.55pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal"><span style="font-size:12.0pt;
  font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
  mso-fareast-language:RU">5<o:p></o:p></span></p>
  <p class="MsoNormal" align="center" style="margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal"><span style="font-size:12.0pt;
  font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
  mso-fareast-language:RU">«отлично»<o:p></o:p></span></p>
  </td>
  <td ="503" style=": 400.4pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">демонстрирует
  глубокое знание теоретического материала, умение обоснованно излагать свои
  мысли по обсуждаемым вопросам, способность </span><span style="font-size:
  12.0pt;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
  mso-fareast-language:RU">полно, правильно и аргументированно </span><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">отвечать на
  вопросы,</span><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:RU"> приводить
  примеры<o:p></o:p></span></p>
  </td>
 </tr>
 <tr>
  <td ="178" style=": 81.55pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal"><span style="font-size:12.0pt;
  font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
  mso-fareast-language:RU">4<o:p></o:p></span></p>
  <p class="MsoNormal" align="center" style="margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal"><span style="font-size:12.0pt;
  font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
  mso-fareast-language:RU">«хорошо»<o:p></o:p></span></p>
  </td>
  <td ="503" style=": 400.4pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">демонстрирует
  знание теоретического материала, его последовательное изложение, способность
  приводить примеры, допускает единичные ошибки, исправляемые после замечания
  преподавателя </span><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:RU"><o:p></o:p></span></p>
  </td>
 </tr>
 <tr>
  <td ="178" style=": 81.55pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal"><span style="font-size:12.0pt;
  font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
  mso-fareast-language:RU">3<o:p></o:p></span></p>
  <p class="MsoNormal" align="center" style="margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal"><span style="font-size:12.0pt;
  font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
  mso-fareast-language:RU">«удовлетворительно»<o:p></o:p></span></p>
  </td>
  <td ="503" style=": 400.4pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">демонстрирует
  неполное, фрагментарное знание теоретического материала, требующее наводящих
  вопросов преподавателя</span><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:RU">, </span><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif">допускает
  существенные ошибки в его изложении, </span><span style="font-size:12.0pt;
  font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
  mso-fareast-language:RU">затрудняется в приведении примеров и формулировке
  выводов<o:p></o:p></span></p>
  </td>
 </tr>
 <tr>
  <td ="178" style=": 81.55pt; border-right-: 1pt; border-bottom-: 1pt; border-left-: 1pt; border-right-color: windowtext; border-bottom-color: windowtext; border-left-color: windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt;">
  <p class="MsoNormal" align="center" style="margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal"><span style="font-size:12.0pt;
  font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
  mso-fareast-language:RU">2<o:p></o:p></span></p>
  <p class="MsoNormal" align="center" style="margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal"><span style="font-size:12.0pt;
  font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:&quot;Times New Roman&quot;;
  mso-fareast-language:RU">«неудовлетворительно»<o:p></o:p></span></p>
  </td>
  <td ="503" style=": 400.4pt; border-top: none; border-left: none; border-bottom-: 1pt; border-bottom-color: windowtext; border-right-: 1pt; border-right-color: windowtext; padding: 0cm 5.4pt;">
  <p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
  mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:RU">демонстрирует
  существенные пробелы в знании теоретического материала, не способен его
  изложить и ответить на наводящие вопросы преподавателя, не может привести
  примеры<o:p></o:p></span></p>
  </td>
 </tr>
</tbody></table>

</div><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:normal;mso-outline-level:2;tab-stops:
right lined 17.0cm"><b><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;;color:#00B050;mso-fareast-language:
RU">&nbsp;</span></b></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;tab-stops:
82.95pt"><span style="font-size:12.0pt;line-height:107%;font-family:&quot;Times New Roman&quot;,serif;
mso-fareast-font-family:&quot;Times New Roman&quot;;mso-fareast-language:RU">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <o:p></o:p></span></p><p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
justify;text-indent:35.45pt;line-height:115%;mso-outline-level:2;tab-stops:
right lined 17.0cm">
</p><p class="MsoNormal"><span style="font-size:12.0pt;
line-height:107%;font-family:&quot;Times New Roman&quot;,serif;mso-fareast-font-family:
&quot;Times New Roman&quot;;mso-fareast-language:RU">&nbsp;</span></p>';

// это ин-яз
//$html .= '<p style="text-align: justify;">Для достижения соответствующего уровня владения общекультурными и общепрофессиональными компетенциями, перечисленными в разделе 3 данной программы, кафедра английского языка (направление Международный бизнес)) применяет следующие формы обучения иностранному (английскому) языку: аудиторные занятия с преподавателем, занятия в лингафонном кабинете/компьютерном классе, оснащенном современным мультимедийным оборудованием с выходом в Интернет, а также самостоятельную работу студентов, внеаудиторную работу студентов.</p><p style="text-align: justify;">В процессе изучения английского языка используются как традиционные технологии, формы и методы обучения, так и инновационные технологии, активные и интерактивные формы проведения занятий, такие как:</p><p style="text-align: justify;">•	доклады и обсуждение подготовленных студентами докладов;</p><p style="text-align: justify;">•	дискуссии;</p><p style="text-align: justify;">•	ролевые и симуляционные деловые игры;</p><p style="text-align: justify;">•	мини деловые ситуации;</p><p style="text-align: justify;">•	индивидуальные и групповые презентации в PowerPoint;</p><p style="text-align: justify;">•	творческие проекты;</p><p style="text-align: justify;">•	самостоятельная работа студента по заданию преподавателя, выполняемую во внеаудиторное время, в которую входит освоение теоретического материала, подготовка к практическим занятиям, выполнение письменных и устных видов домашней работы, в том числе с использованием мультимедийных средств;</p><p style="text-align: justify;">•	индивидуальную самостоятельную работу студента под руководством преподавателя;</p><p style="text-align: justify;">•	индивидуальные консультации.</p><p style="text-align: justify;">Комплексное использование в учебном процессе всех вышеназванных технологий позволяет стимулировать личностную и интеллектуальную активность студентов, а также способствует формированию общекультурных и общепрофессиональных компетенций, которыми должен обладать будущий специалист.</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">7.	ОЦЕНОЧНЫЕ СРЕДСТВА</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Проверка прочности знаний и уровня сформированности речевых умений и навыков студентов осуществляется в форме текущего и промежуточного контроля.</p><p style="text-align: justify;">Внутрисеметровая оценка успеваемости студентов осуществляется в процессе текущей работы на основе балльно-рейтинговой системы. Максимальная сумма баллов, которую в процессе обучения студент может набрать по дисциплине за семестр, равна 100 баллам.</p><p style="text-align: justify;">Максимальное количество баллов за работу в семестре - 70. Формирование данной цифры происходит следующим образом:</p><p style="text-align: justify;">•	работа на занятии и выполнение домашних заданий – максимально 10 баллов ежемесячно;</p><p style="text-align: justify;">•	контрольная работа – максимально 5 баллов (4 контрольные работы в семестр);</p><p style="text-align: justify;">•	10 бонусных баллов (участие во внеклассном мероприятии по дисциплине).</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">7.1 Текущий контроль проводится преподавателем на каждом занятии с целью проверки уровня владения изучаемого лексико-грамматического материала или степени сформированности частных навыков и умений. Может предлагаться в следующих формах:</p><p style="text-align: justify;">•	фронтальные и индивидуальные опросы: проверка домашних заданий и выполнение упражнений на занятии с целью определения качества усвоения нового лексического, грамматического материала; проверка знания терминологического словаря студентов,</p><p style="text-align: justify;">•	контрольная работа (из расчета 4 работы в семестр). Контрольные работы состоят из заданий на проверку основных навыков и умений по трем видам речевой деятельности (чтение, письмо, аудирование). Оценка успеваемости студентов по дисциплине «Иностранный язык, английский» по окончании каждого семестра осуществляется на основе балльно-рейтинговой системы. (см. Приложение 1).</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">№ п/п	Наименование раздела дисциплины	Средства текущего контроля</p><p style="text-align: justify;">1	Иностранный язык (Английский язык)	устный опрос с целью проверки уровня владения изучаемого лексико-грамматического материала и/или степени сформированности частных навыков и умений, контрольная работа, диалоги, сообщения</p><p style="text-align: justify;">2	Иностранный язык (Английский язык)	устный опрос с целью проверки уровня владения изучаемого лексико-грамматического материала и/или степени сформированности частных навыков и умений, контрольная работа, диалоги, сообщения, доклад</p><p style="text-align: justify;">3	Иностранный язык (Английский язык)	устный опрос с целью проверки уровня владения изучаемого лексико-грамматического материала и/или степени сформированности частных навыков и умений, контрольная работа, диалоги, сообщения, доклад</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">7.2 Промежуточный контроль осуществляется в конце 1, 2 и 3 семестров в форме экзамена. Студенты допускаются к экзамену по дисциплине в случае выполнения учебного плана, включая выполнение всех соответствующих заданий и контрольных работ, предусмотренных программой дисциплины по форме текущего контроля. В случае наличия учебной задолженности студент отчитывается за пропущенный материал и выполняет пропущенные контрольные работы. Экзамен прроводят руководитель курса/потока и ведущий преподаватель группы.</p><p style="text-align: justify;">Максимальное количество баллов - 30.</p><p style="text-align: justify;">Структура экзамена/дифференцированного зачета, предусмотренного по окончании 1-3 семестров обучения:</p><p style="text-align: justify;">А) Письменная работа. В работе представлены задания по аспектам General English и Business English. Время написания работы - 4 академических часа.</p><p style="text-align: justify;">Б) Аудирование. Продолжительность до 15 минут при двукратном предъявлении.</p><p style="text-align: justify;">В) Устный экзамен:</p><p style="text-align: justify;">1) Монологическое высказывание (15-20 предложений) по одной из тем, изученных в течение семестра (аспекты General/Business English).</p><p style="text-align: justify;">Время на подготовку - 15 минут.</p><p style="text-align: justify;">2) Диалог с партнером-студентом по предложенному заданию без предварительного контакта партнеров.</p><p style="text-align: justify;">Время на подготовку - 15 минут. Количество реплик 10-15 от каждого кандидата.</p><p style="text-align: justify;">3) Студенту также предлагается:</p><p style="text-align: justify;">- устно без подготовки перевести предложения с русского языка на английский в рамках изученного материала;</p><p style="text-align: justify;">- побеседовать с преподавателем по материалу книг по домашнему чтению (на усмотрение экзаменатора);</p><p style="text-align: justify;">- ответить на дополнительные вопросы экзаменатора по пройденному материалу (на усмотрение экзаменатора).</p><p style="text-align: justify;">Критерии оценки промежуточной аттестации</p><p style="text-align: justify;">Оценка знаний студента на экзамене носит комплексный характер, является балльной и определяется:</p><p style="text-align: justify;">•	ответом студента на экзамене (максимум 30 баллов);</p><p style="text-align: justify;">•	учебными достижениями в семестровый период. Оценка работы студента в течение семестра составляет в сумме до 70 баллов.</p><p style="text-align: justify;">Максимальный результат равен 100 баллам. Перевод 100-балльного результата в пятибалльную оценку осуществляется по схеме, приведенной ниже (см. Критерии оценки промежуточной аттестации).</p><p style="text-align: justify;">Студенту выставляется оценка в соответствии с балльно-рейтинговой системой.</p><p style="text-align: justify;"><br></p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Распределение максимальных баллов по видам работы:</p><p style="text-align: justify;">№ п/п	Вид отчетности	Баллы</p><p style="text-align: justify;">1.	Текущая работа	70</p><p style="text-align: justify;">2.	Зачет	30</p><p style="text-align: justify;">3.	Итого:	100</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Студент, набравший в течение семестра и на экзамене не менее 52 баллов, считается не сдавшим экзамен. Неудовлетворительная оценка по промежуточному контролю предполагает переэкзаменовку.</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Критерии оценки промежуточной аттестации за письменную часть экзамена/зачета</p><p style="text-align: justify;">Знания, умения и навыки студента на экзамене/зачете оцениваются (в баллах):</p><p style="text-align: justify;">•	за письменную часть экзамена/зачета:</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Отлично	Хорошо	Удовлетворительно	Неудовлетворительно</p><p style="text-align: justify;">85-100%	84-75%	74-52%	51% и менее</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Критерии оценки устной части экзамена/зачета</p><p style="text-align: justify;">•	за устную монологическую часть:</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Отлично	Хорошо	Удовлетворительно	Неудовлетворительно</p><p style="text-align: justify;">оценка «отлично» выставляется студенту, если ответ по теме билета не зачитывается, задание выполнено по определенному формату, соответствует выбранной теме, интересно и информативно, используется ключевая лексика, привлечен дополнительный материал, студент свободно и правильно отвечает на вопросы.	оценка «хорошо»</p><p style="text-align: justify;">выставляется студенту, если ответ по теме билета частично зачитывается, задание выполнено по определенному формату, соответствует выбранной теме, используется ключевая лексика, привлечен дополнительный материал, студент свободно и правильно отвечает на вопросы.</p><p style="text-align: justify;">оценка «удовлетворительно» выставляется студенту, если ответ по теме билета зачитывается, задание соответствует выбранной теме, но выполнено не по требуемому формату, используется ключевая лексика, не привлечен дополнительный материал и/или аудиовизуальные средства, студент испытывает трудности при ответах на вопросы.</p><p style="text-align: justify;">оценка «неудовлетворительно»</p><p style="text-align: justify;">выставляется студенту, если он не подготовил сообщение по теме билета.</p><p style="text-align: justify;"><br></p><p style="text-align: justify;"><br></p><p style="text-align: justify;">•	за устную часть по деловой проблеме (диалог):</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Отлично	Хорошо	Удовлетворительно	Неудовлетворительно</p><p style="text-align: justify;">оценка «отлично» выставляется студенту, если он свободно владеет лексикой, понимает собеседника, грамматически правильно выстраивает предложения, предлагает решение проблемы.	оценка «хорошо» выставляется студенту, если он владеет лексикой, понимает собеседника, отвечает краткими предложениями</p><p style="text-align: justify;">оценка «удовлетворительно» выставляется студенту, если он слабо владеет лексикой, не полностью понимает собеседника, не принимает участие в поиске решения.</p><p style="text-align: justify;">оценка «неудовлетворительно» выставляется студенту, если он не владеет лексикой, не понимает собеседника, не участвует в обсуждении.</p><p style="text-align: justify;"><br></p><p style="text-align: justify;"><br></p><p style="text-align: justify;">8. УЧЕБНО-МЕТОДИЧЕСКОЕ И ИНФОРМАЦИОННОЕ ОБЕСПЕЧЕНИЕ ДИСЦИПЛИНЫ</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">8.1 Основная литература:</p><p style="text-align: justify;">1.	Barral I., Barral N. Intelligent Business. Workbook (Pre – Intermediate). Longman, 2006.</p><p style="text-align: justify;">2.	Barral I., Barral N. Intelligent Business. Skillsbook (Pre – Intermediate). Longman, 2006.</p><p style="text-align: justify;">3.	Cotton D., Falvey D., Kent S. New Language Leader (Upper-Intermediate). Pearson, 2014.</p><p style="text-align: justify;">4.	Johnson C. Intelligent Business. Coursebook (Pre–Intermediate), 3rd edition. Longman, 2008.</p><p style="text-align: justify;">5.	Raitskaya L., Cochrane S. Guide to Economics. Coursebook. Macmillan, 2007.</p><p style="text-align: justify;">6.	Soars J., Soars L. New Headway Upper-Intermediate (4 edition), Oxford University Press, 2014.</p><p style="text-align: justify;">7.	 Soars J., Soars L. New Headway Pre- Intermediate (4th edition), Oxford University Press, 2016.</p><p style="text-align: justify;">8.	Гавриленко А.Н., Тюрева Ю.В. A Guide to Better Grammar, Part 1 (учебное пособие для студентов 1 курса ФВМ), М.: ВАВТ, 2019.(переиздание)</p><p style="text-align: justify;">9.	Гавриленко А.Н., Тюрева Ю.В. A Guide to Better Grammar. Part 2 (учебное пособие для студентов 1 курса ФВМ), М.: ВАВТ, 2019 (переиздание)</p><p style="text-align: justify;">10.	Финякина А.Н. Handbook of Commercial Correspondence. (учебное пособие). М.: ВАВТ, 2019 (переиздание).</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">8.2	Дополнительная литература:</p><p style="text-align: justify;">1.	Мансурова М.Ф “Gurus in Management” (учебное пособие для чтения с упражнениями) М.: ВАВТ, 2019 (переиздание).</p><p style="text-align: justify;">2.	Мансурова М.Ф. The Growing World of Commerce (учебное пособие для чтения с упражнениями), М.: ВАВТ, 2019 (переиздание)</p><p style="text-align: justify;">3.	Семенова Е.Ю., Макаренко В.П., Афанасьева Н.И. ‘Numbers for Businessmen”.(учебное пособие на основе “Count Me In’, “Presenting Facts and Figures”. М.:ВАВТ, 2019 (переиздание).</p><p style="text-align: justify;">4.	Гавриленко А.Н., Лебедева И.В., Тюрева Ю.В. Additional vocabulary tasks, Part 1 (учебное пособие для студентов 1 курса ФВМ). М.: ВАВТ, 2019 (переиздание)</p><p style="text-align: justify;">Гавриленко А.Н., Лебедева И.В., Тюрева Ю.В. Additional vocabulary tasks, Part 2 (учебное пособие для студентов 1 курса ФВМ). М.: ВАВТ, 2019 (переиздание)</p><p style="text-align: justify;">5.	Evans D. Women in Business – Pearson ELT, 2001. <a classname="e-rte-anchor" href="https://fobook.ru/women-in-business" title="https://fobook.ru/women-in-business" target="_blank">https://fobook.ru/women-in-business </a></p><p style="text-align: justify;">6.	Grisham J. The Pelican Brief / retold by Robin Waterfield - Pearson ELT, 2008. <a classname="e-rte-anchor" href="http://www.e4thai.com/e4e/images/pdf/JohnGrisham/John%20Grisham-%20The%20Pelican%20Brief.pdf" title="http://www.e4thai.com/e4e/images/pdf/JohnGrisham/John%20Grisham-%20The%20Pelican%20Brief.pdf" target="_blank">http://www.e4thai.com/e4e/images/pdf/JohnGrisham/John%20Grisham-%20The%20Pelican%20Brief.pdf </a></p><p style="text-align: justify;"><br></p><p style="text-align: justify;">8.3 Перечень информационных справочных систем и профессиональных баз данных</p><p style="text-align: justify;">1.https://www.biztree.com/ - онлайн библиотека образцов деловых и юридических писем на английском языке</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">8.4	Перечень программного обеспечения</p><p style="text-align: justify;">1.	Операционная система Windows;</p><p style="text-align: justify;">2.	Microsoft Office;</p><p style="text-align: justify;">3.	ABBYY FineReader 12 Corporate;</p><p style="text-align: justify;">4.	Антивирус Kaspersky</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">9. МАТЕРИАЛЬНО-ТЕХНИЧЕСКОЕ ОБЕСПЕЧЕНИЕ ДИСЦИПЛИНЫ</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Реализация программы предполагает наличие учебных кабинетов:</p><p style="text-align: justify;">•	лекционная аудитория, оборудованная видеопроекционной аппаратурой, экраном, компьютером;</p><p style="text-align: justify;">•	кабинет для практических занятий (компьютерный класс), имеющий видеопроекционную аппаратуру с возможностью подключения к ПК, экран, персональные компьютеры с возможностью подключения к информационно-телекоммуникационной сети Internet.</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">10	ОБЕСПЕЧЕНИЕ ДОСТУПНОСТИ ОСВОЕНИЯ ПРОГРАММЫ ОБУЧАЮЩИМИСЯ С ОГРАНИЧЕННЫМИ ВОЗМОЖНОСТЯМИ ЗДОРОВЬЯ</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Условия организации и содержание обучения и контроля знаний обучающихся с ограниченными возможностями здоровья (далее – ОВЗ) определяются программой дисциплины, адаптированной при необходимости для обучения указанных обучающихся.</p><p style="text-align: justify;">Организация обучения, текущей и промежуточной аттестации студентов с ОВЗ осуществляется с учетом особенностей психофизического развития, индивидуальных возможностей и состояния здоровья таких обучающихся. Исходя из психофизического развития и состояния здоровья студентов с ОВЗ, организуются занятия совместно с другими обучающимися в общих группах, используя социально-активные и рефлексивные методы обучения создания комфортного психологического климата в студенческой группе или, при соответствующем заявлении такого обучающегося, по индивидуальной программе, которая является модифицированным вариантом основной рабочей программы дисциплины. При этом содержание программы дисциплины не изменяется. Изменяются, как правило, формы обучения и контроля знаний, образовательные технологии и учебно-методические материалы.</p><p style="text-align: justify;">Обучение студентов с ОВЗ также может осуществляться индивидуально и/или с применением элементов электронного обучения. Электронное обучение обеспечивает возможность коммуникаций с преподавателем, а также с другими обучаемыми посредством вебинаров (например, с использованием программы Skype), что способствует сплочению группы, направляет учебную группу на совместную работу, обсуждение, принятие группового решения. В образовательном процессе для повышения уровня восприятия и переработки учебной информации студентов с ОВЗ применяются мультимедийные и специализированные технические средства приема-передачи учебной информации в доступных формах для обучающихся с различными нарушениями, обеспечивается выпуск альтернативных форматов печатных материалов (крупный шрифт), электронных образовательных ресурсов в формах, адаптированных к ограничениям здоровья обучающихся, наличие необходимого материально-технического оснащения. Подбор и разработка учебных материалов производится преподавателем с учетом того, чтобы обучающиеся с нарушениями слуха получали информацию визуально, с нарушениями зрения – аудиально (например, с использованием программ-синтезаторов речи).</p><p style="text-align: justify;">Для осуществления процедур текущего контроля успеваемости и промежуточной аттестации обучающихся лиц с ОВЗ фонд оценочных средств по дисциплине, позволяющий оценить достижение ими результатов обучения и уровень сформированности компетенций, предусмотренных учебным планом и рабочей программой дисциплины, адаптируется для лиц с ограниченными возможностями здоровья с учетом индивидуальных психофизиологических особенностей (устно, письменно на бумаге, письменно на компьютере, в форме тестирования и т.п.). При необходимости обучающимся предоставляется дополнительное время для подготовки ответа при прохождении всех видов аттестации.</p><p style="text-align: justify;">Особые условия предоставляются обучающиеся с ограниченными возможностями здоровья на основании заявления, содержащего сведения о необходимости создания соответствующих специальных условий.</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">11. МЕТОДИЧЕСКИЕ УКАЗАНИЯ ДЛЯ ОБУЧАЮЩИХСЯ ПО ОСВОЕНИЮ ДИСЦИПЛИНЫ</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">11.1 Методические рекомендации по изучению дисциплины</p><p style="text-align: justify;">Студентам необходимо ознакомиться: с содержанием рабочей программы дисциплины (далее – РПД), с целями и задачами дисциплины, ее связями с другими дисциплинами образовательной программы, методическими разработками по данной дисциплине, имеющимися на образовательном портале и сайте кафедры, с графиком консультаций преподавателей данной кафедры.</p><p style="text-align: justify;">Советы по планированию и организации времени, необходимого на изучение дисциплины. Рекомендуемое распределение времени на изучение дисциплины указано в разделе «Структура и содержание дисциплины». В целях более плодотворной работы в семестре студенты также могут ознакомиться с планом дисциплины, составленным преподавателем – как для лекционных, так и для практических занятий.</p><p style="text-align: justify;">«Сценарий» изучения дисциплины. «Сценарий» изучения дисциплины студентом подразумевает выполнение им следующих действий:</p><p style="text-align: justify;">•	ознакомление с целями и задачами дисциплины;</p><p style="text-align: justify;">•	ознакомление с требованиями к знаниям и навыкам студента;</p><p style="text-align: justify;">•	первичное ознакомление с разделами и темами дисциплины;</p><p style="text-align: justify;">•	ознакомление с распределением времени на изучение дисциплины;</p><p style="text-align: justify;">•	ознакомление со списками рекомендуемой основной и дополнительной литературы по дисциплине;</p><p style="text-align: justify;">•	углублённое ознакомление с разделами и темами дисциплины;</p><p style="text-align: justify;">•	предварительный охват на основе рекомендуемой литературы круга вопросов, актуальных для конкретного занятия;</p><p style="text-align: justify;">•	самостоятельная проработка основного круга вопросов как каждого последующего, так и каждого предыдущего занятия в свободное время между занятиями по дисциплине;</p><p style="text-align: justify;">•	присутствие и творческое участие на лекционных и семинарских / практических занятиях;</p><p style="text-align: justify;">•	выполнение требований планового текущего и итогового контроля;</p><p style="text-align: justify;">•	уточнение возникающих вопросов на консультации по дисциплине;</p><p style="text-align: justify;">•	непосредственная подготовка к экзамену по дисциплине на основе выданных преподавателем вопросов к экзамену.</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">11.2 Рекомендации по подготовке к практическим (семинарским) занятиям</p><p style="text-align: justify;">Студентам следует:</p><p style="text-align: justify;">•	приносить с собой рекомендованную преподавателем литературу к конкретному занятию;</p><p style="text-align: justify;">•	до очередного практического занятия по рекомендованным литературным источникам проработать теоретический материал, соответствующей темы занятия;</p><p style="text-align: justify;">•	при подготовке к практическим занятиям следует обязательно использовать не только лекции, учебную литературу, но и нормативно-правовые акты и материалы правоприменительной практики;</p><p style="text-align: justify;">•	теоретический материал следует соотносить с правовыми нормами, так как в них могут быть внесены изменения, дополнения, которые не всегда отражены в учебной литературе;</p><p style="text-align: justify;">•	в начале занятий задать преподавателю вопросы по материалу, вызвавшему затруднения в его понимании и освоении при решении задач, заданных для самостоятельного решения;</p><p style="text-align: justify;">•	в ходе семинара давать конкретные, четкие ответы по существу вопросов;</p><p style="text-align: justify;">•	на занятии доводить каждую задачу до окончательного решения, демонстрировать понимание проведенных расчетов (анализов, ситуаций), в случае затруднений обращаться к преподавателю.</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">11.3 Методические рекомендации по выполнению различных форм самостоятельных домашних заданий</p><p style="text-align: justify;">Самостоятельная работа студентов включает в себя выполнение различного рода заданий, которые ориентированы на более глубокое усвоение материала изучаемой дисциплины. По каждой теме учебной дисциплины студентам предлагается перечень заданий для самостоятельной работы.</p><p style="text-align: justify;">К выполнению заданий для самостоятельной работы предъявляются следующие требования: задания должны исполняться самостоятельно и представляться в установленный срок, а также соответствовать установленным требованиям по оформлению.</p><p style="text-align: justify;">Студентам следует:</p><p style="text-align: justify;">•	руководствоваться графиком самостоятельной работы, определенным РПД;</p><p style="text-align: justify;">•	выполнять все плановые задания, выдаваемые преподавателем для самостоятельного выполнения, и разбирать на семинарах и консультациях неясные вопросы;</p><p style="text-align: justify;">при подготовке к промежуточной аттестации параллельно прорабатывать соответствующие теоретические и практические разделы дисциплины, фиксируя неясные моменты для их обсуждения на плановой консультации.</p><p style="text-align: justify;"><br></p><p style="text-align: justify;"><br></p><p style="text-align: justify;"><br></p><p style="text-align: justify;">12.АННОТАЦИЯ</p><p style="text-align: justify;">рабочей программы дисциплины</p><p style="text-align: justify;">«ИНОСТРАННЫЙ ЯЗЫК»</p><p style="text-align: justify;">(английский)</p><p style="text-align: justify;">Форма и курс обучения – очная форма, 1-2 курс, 1-3 семестры</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">1.	Цель дисциплины: формирование у студентов иноязычной профессионально-коммуникативной компетенции, уровень которой на отдельных этапах языковой подготовки позволяет использовать иностранный (английский) язык на практике как в профессиональной (производственной и научной) деятельности, так и в целях самообразования, и представляет собой готовность и способность осуществлять иноязычное общение в условиях межкультурной профессиональной коммуникации.</p><p style="text-align: justify;">2.	Место дисциплины в структуре ОПОП бакалавриата: данная дисциплина относится к обязательной части ООП.</p><p style="text-align: justify;">3. Общая трудоемкость дисциплины составляет 16 зачетных единиц (576 часа).</p><p style="text-align: justify;">4. Семестры: 1-3.</p><p style="text-align: justify;">5. Основные разделы дисциплины:</p><p style="text-align: justify;">Содержание разделов дисциплины, предлагаемых в 1и 2 семестрах</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">№	General English	Business English</p><p style="text-align: justify;">1	Getting to know you	Business activities.</p><p style="text-align: justify;">2	Whatever makes you happy.	Collecting and managing data in work. Surveillance technology.</p><p style="text-align: justify;">3	What’s in the news?	Etiquette.</p><p style="text-align: justify;">4	Accidents. Natural disasters.	Brands.</p><p style="text-align: justify;">5	Eat, drink and be merry.	Starting up a new business.</p><p style="text-align: justify;">6	Looking forward.	Risky ventures. Problems in the company.</p><p style="text-align: justify;">7	Living History.	Job-seeking.</p><p style="text-align: justify;">8	Girls and boys.	Selling a product.</p><p style="text-align: justify;">9	Our interactive world.	Price. Pricing strategy.</p><p style="text-align: justify;">10	Life is what you make it.	Study of economics.</p><p style="text-align: justify;">11	Just wondering.	Microeconomics and Macroeconomics.</p><p style="text-align: justify;">12	A world of differences.	History of economic thought.</p><p style="text-align: justify;">13	The working week	Traditional /market/planned/mixed economy.</p><p style="text-align: justify;">14	Good times, bad times	Costs and supply.</p><p style="text-align: justify;">15	Getting it right	Market strucrure and competition.</p><p style="text-align: justify;">16	Our changing world	Monopolies</p><p style="text-align: justify;">17	What matters to me	The Labour market.</p><p style="text-align: justify;">18	Passions and fashions	Supply of labour.</p><p style="text-align: justify;">19	No fear!	Surplus.</p><p style="text-align: justify;">20	It depends how you look at it.	Price discrimination.</p><p style="text-align: justify;">21	All things high tech.</p><p style="text-align: justify;">22	Seeing is believing.</p><p style="text-align: justify;">23	Telling it how it is</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Содержание разделов дисциплины, предлагаемых в 3 семестре обучения</p><p style="text-align: justify;">№	General English	Business English</p><p style="text-align: justify;">1	Background information.	Telephoning.</p><p style="text-align: justify;">2	Free time. Hobbies and interests. Books, films, music.	Welfare economics..</p><p style="text-align: justify;">3	Family and friends. Describing people.	Government revenue and spending.</p><p style="text-align: justify;">4	Holidays, travelling.	Wealth, income and inequality.</p><p style="text-align: justify;">5	Shopping. Buying things.	Poverty.</p><p style="text-align: justify;">6	Health. Risky sport, fitness.	Macroeconomics.</p><p style="text-align: justify;">7	School and studying at university.	Aggregate demand and aggregate supply.</p><p style="text-align: justify;">8	Work and jobs. Housework. Career plans.	Money.</p><p style="text-align: justify;">9	Food. Eating out.	Insurance.</p><p style="text-align: justify;">10	Literature and film.	Service.</p><p style="text-align: justify;">11	Accidents. Natural disasters.	Productivity.</p><p style="text-align: justify;">12	Breakthroughs in science.	Creativity.</p><p style="text-align: justify;">13	Medicine.	Motivation.</p><p style="text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6. Форма контроля – экзамен</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">13. ОЦЕНОЧНЫЕ МАТЕРИАЛЫ</p><p style="text-align: justify;">13.1. Паспорт оценочных средств</p><p style="text-align: justify;">Соответствие разделов, тем дисциплины (модуля),</p><p style="text-align: justify;">результатов обучения по дисциплине (модулю) и оценочных средств</p><p style="text-align: justify;">Таблица 6</p><p style="text-align: justify;">Код и наименование</p><p style="text-align: justify;">компетенции	Код (ы) и наименование (-ия) индикатора(ов)</p><p style="text-align: justify;">достижения компетенций	Планируемые результаты обучения</p><p style="text-align: justify;">Наименование оценочного средства</p><p style="text-align: justify;">УК-4 Способен осуществлять деловую коммуникацию в устной и письменной формах на государственном языке Российской Федерации и иностранном(ых) языке(ах)	ИДК1. УК-4. Знает, понимает и применяет нормы устной и письменной речи, принятые в профессиональной среде.</p><p style="text-align: justify;">Знать:</p><p style="text-align: justify;">- формы деловой коммуникации при взаимодействии с представителями зарубежных компаний; коммуникативные технологии в устной и письменной формах для решения профессиональных задач в межкультурной среде	устный опрос с целью проверки уровня владения изучаемого лексико-грамматического материала и/или степени сформированности частных навыков и умений, контрольная работа,</p><p style="text-align: justify;">диалоги, сообщения</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Уметь:</p><p style="text-align: justify;">- применять на практике знания в области деловой коммуникации при взаимодействии с зарубежными партнерами</p><p style="text-align: justify;">Владеть:</p><p style="text-align: justify;">- навыками применения коммуникативных инструментов для повышения качества делового общения с представителями зарубежных организаций</p><p style="text-align: justify;">ИДК2. УК-4. Умеет выбирать стиль общения на русском и иностранном языках применительно к ситуации взаимодействия.</p><p style="text-align: justify;">Знать:</p><p style="text-align: justify;">- лингвистические, в том числе стилистические особенности государственного и иностранного языков, а также специфику официального, нейтрального и неофициального регистров общения; правила поведения и этикетные нормы делового и профессионального общения.</p><p style="text-align: justify;">Уметь:</p><p style="text-align: justify;">- выбирать стиль делового общения и продуцировать высказывания делового и профессионального характера, учитывая цели, условия и ситуацию общения;</p><p style="text-align: justify;">Владеть:</p><p style="text-align: justify;">- навыками продуцирования связного и логически структурированного высказывания делового и профессионального характера в соответствии с особенностями ситуации общения на уровне, обеспечивающим эффективную профессиональную деятельность</p><p style="text-align: justify;">устный опрос с целью проверки уровня владения изучаемого лексико-грамматического материала и/или степени сформированности частных навыков и умений, контрольная работа,</p><p style="text-align: justify;">диалоги, сообщения,</p><p style="text-align: justify;">доклад</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">ОПК-7. Способен осуществлять внутриорганизационные и межведомственные коммуникации, обеспечивать взаимодействие органов власти с гражданами, коммерческими организациями, институтами гражданского общества, средствами массовой информации	ИДК1.ОПК-7. Применяет основы делового общения, принципы и методы организации деловых коммуникаций</p><p style="text-align: justify;">Знает:</p><p style="text-align: justify;">- формы деловой коммуникации при взаимодействии с представителями</p><p style="text-align: justify;">гражданами, коммерческими организациями, зарубежными партнерами и др.</p><p style="text-align: justify;">Умеет:</p><p style="text-align: justify;">- осуществлять коммуникацию на иностранном языке для решения социально-коммуникативных задач в профессиональной деятельности</p><p style="text-align: justify;">Владеет:</p><p style="text-align: justify;">- способностью осуществлять переписку на иностранном языке	устный опрос с целью проверки уровня владения изучаемого лексико-грамматического материала и/или степени сформированности частных навыков и умений, контрольная работа,</p><p style="text-align: justify;">диалоги, сообщения,</p><p style="text-align: justify;">доклад, презентации, анализ конкретных профессиональных ситуаций (кейсов)</p><p style="text-align: justify;">ИДК3.ОПК-7. Использует межведомственные коммуникации в профессиональной деятельности	Знает:</p><p style="text-align: justify;">-сущность и методы коммуникаций, их роль и место в процессе управления</p><p style="text-align: justify;">Умеет:</p><p style="text-align: justify;">- использовать в своей речи вербальные и невербальные средства профессионального взаимодействия с партнерами общения; использовать этикетные формулы устной и письменной коммуникации</p><p style="text-align: justify;">Владеет:</p><p style="text-align: justify;">- навыками деловой переписки. и поддержания электронных коммуникаций</p><p style="text-align: justify;"><br></p><p style="text-align: justify;"><br></p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Содержание разделов дисциплины, предлагаемых в 1 и 2 семестрах</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Контролируемые разделы (темы)</p><p style="text-align: justify;">№	General English	Business English</p><p style="text-align: justify;">1	Getting to know you.	Business activities.</p><p style="text-align: justify;">2	Whatever makes you happy.	Collecting and managing data in work. Surveillance technology.</p><p style="text-align: justify;">3	What’s in the news?	Etiquette.</p><p style="text-align: justify;">4	Accidents. Natural disasters.	Brands.</p><p style="text-align: justify;">5	Eat, drink and be merry.	Starting up a new business.</p><p style="text-align: justify;">6	Looking forward.	Risky ventures. Problems in the company.</p><p style="text-align: justify;">7	Living History.	Job-seeking.</p><p style="text-align: justify;">8	Girls and boys.	Selling a product.</p><p style="text-align: justify;">9	Our interactive world.	Price. Pricing strategy.</p><p style="text-align: justify;">10	Life is what you make it.	Study of economics.</p><p style="text-align: justify;">11	Just wondering.	Microeconomics and Macroeconomics.</p><p style="text-align: justify;">12	A world of differences.	History of economic thought.</p><p style="text-align: justify;">13	The working week.	Traditional /market/planned/mixed economy.</p><p style="text-align: justify;">14	Good times, bad times.	Costs and supply.</p><p style="text-align: justify;">15	Getting it right.	Market structure and competition.</p><p style="text-align: justify;">16	Our changing world.	Monopolies.</p><p style="text-align: justify;">17	What matters to me.	Labour market.</p><p style="text-align: justify;">18	Passions and fashions.	Supply of labour.</p><p style="text-align: justify;">19	No fear!	Surplus.</p><p style="text-align: justify;">20	It depends how you look at it.	Price discrimination.</p><p style="text-align: justify;">21	All things high tech.</p><p style="text-align: justify;">22	Seeing is believing.</p><p style="text-align: justify;">23	Telling it how it is.</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Содержание разделов дисциплины, предлагаемых в 3 семестре обучения</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Контролируемые разделы (темы)</p><p style="text-align: justify;">№	General English	Business English</p><p style="text-align: justify;">1	Background information.	Telephoning.</p><p style="text-align: justify;">2	Free time. Hobbies and interests. Books, films, music.	Welfare economics.</p><p style="text-align: justify;">3	Family and friends. Describing people.	Government revenue and spending.</p><p style="text-align: justify;">4	Holidays, travelling.	Wealth, income and inequality.</p><p style="text-align: justify;">5	Shopping. Buying things.	Poverty.</p><p style="text-align: justify;">6	Health. Risky sport, fitness.	Macroeconomics.</p><p style="text-align: justify;">7	School and studying at university.	Aggregate demand and aggregate supply.</p><p style="text-align: justify;">8	Work and jobs. Housework. Career plans.	Money.</p><p style="text-align: justify;">9	Food. Eating out.	Insurance.</p><p style="text-align: justify;">10	Literature and film.	Service.</p><p style="text-align: justify;">11	Accidents. Natural disasters.	Productivity.</p><p style="text-align: justify;">12	Breakthroughs in science.	Creativity.</p><p style="text-align: justify;">13	Medicine.	Motivation.</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Наименование оценочного средства:</p><p style="text-align: justify;">Текущий контроль: диктант, беседа по изучаемым темам, сообщения по изучаемым темам; контрольные работы (из расчета 4 работы в семестр).</p><p style="text-align: justify;">Промежуточный контроль: экзамен в конце семестра (в письменной и устной форме).</p><p style="text-align: justify;"><br></p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Формат письменной контрольной работы, предлагаемой в качестве текущего и промежуточного контроля в 1-3 семестрах</p><p style="text-align: justify;">Test</p><p style="text-align: justify;">Reading and Writing</p><p style="text-align: justify;">Task 1. (A) Read the article and decide if the statements below are “Right” or “Wrong”. If there is not enough information in the article, choose “Doesn’t say”.</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Hot data</p><p style="text-align: justify;">Some simple, cheap measures could help protect personal data</p><p style="text-align: justify;">The theft of data, often involving personal information about customers and employees, is increasing dangerously fast. After data on 40m credit-card accounts were stolen from the computers of a data-processing firm based in Atlanta, Georgia, business leaders and politicians everywhere are taking notice.</p><p style="text-align: justify;">Data theft accounted for over $50 billion in losses last year in America alone. Careless information-security practices have left vulnerable the personal information – such as financial details, health records and Social Security numbers – of around 50m Americans.</p><p style="text-align: justify;">Europe has avoided the spectacular data-protection problems that have been happening in America. That may be in part because it started to take the problem seriously a decade ago. The European Union’s 1995 data-protection directive requires firms to assess their data-protection practices and to document how they handle sensitive information. These simple rules have encouraged firms to address the issue of data security. But the biggest weakness of the European directive is that it does not require firms to report privacy breaches. As a result, it is impossible to say how effective it really been.</p><p style="text-align: justify;">In Japan, companies have to make a public announcement when privacy breaches take place. America and Europe should do the same.</p><p style="text-align: justify;"><br></p><p style="text-align: justify;"><br></p><p style="text-align: justify;">1	1.	People steal more data now than in the past.</p><p style="text-align: justify;">Right	Wrong	Doesn’t say</p><p style="text-align: justify;">2	Thieves stole credit cards from a data-processing firm in Atlanta.</p><p style="text-align: justify;">Right	Wrong	Doesn’t say</p><p style="text-align: justify;">3	3	The unprotected details include information about people’s jobs and addresses.</p><p style="text-align: justify;">Right	Wrong	Doesn’t say</p><p style="text-align: justify;">4	Europeans have worse data-protection problems than America.</p><p style="text-align: justify;">Right	Wrong	Doesn’t say</p><p style="text-align: justify;">5	5	In Europe, the law says that companies must have procedures to look at how to protect data.</p><p style="text-align: justify;">Right	Wrong	Doesn’t say</p><p style="text-align: justify;">6	In Japan, companies don’t have to tell the public if there are any problems with data security.</p><p style="text-align: justify;">Right	Wrong	Doesn’t say</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">(B) Correct any wrong numbers in these sentences.					[5]</p><p style="text-align: justify;">1.	Thieves stole data from 4,000 credit card accounts in Atlanta, USA.</p><p style="text-align: justify;">2.	More than $ 50,000,000.000 was stolen by data theft.</p><p style="text-align: justify;">3.	Approximately 500,000,000 people may have their personal details unprotected.</p><p style="text-align: justify;">4.	Europe began to take data protection seriously over ten years ago.</p><p style="text-align: justify;">5.	The 1985 European Union directive helps to protect data.</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Task 2. Use the proper form of the verbs in brackets.</p><p style="text-align: justify;">1	Our company’s sales _______________ (decline) for some years now.</p><p style="text-align: justify;">2	The new owners _______________ (can) _______________ (revitalize) the company and _______________ (maintain) its traditions of quality.</p><p style="text-align: justify;">3	She still _______________ (hold) a large number of shares in the company, which _______________ (found) by her father.</p><p style="text-align: justify;">4	Anxious employees _______________ (tell) that	 the new Managing Director _______________ (not intend) _______________ (make) anyone redundant, although he may be taking on new managerial staff.</p><p style="text-align: justify;">5	They _______________ (have) large cash reserves which _______________ (enable) them to make yesterday’s purchase without seeking external finance.</p><p style="text-align: justify;"><br></p><p style="text-align: justify;"><br></p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Task 3. Group these words into five synonymic pairs.</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">(a) salary	(c) relevant	(e) appropriate	(g) to seek	(i) post</p><p style="text-align: justify;">(b) applicant	(d) remuneration	(f) position	(h) candidate	(j) to look for</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">a	b	c	d	e</p><p style="text-align: justify;"><br></p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Task 4. Read a letter from Helen Rees. Then on behalf of John Adams write a reply to Helen Rees letter using the block style.</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">MINITOURS PLC</p><p style="text-align: justify;">302 Norris Road, Reading, Berks, D62 1MT, England</p><p style="text-align: justify;">Telephone: (44) 9894200</p><p style="text-align: justify;">Email: info@minitours.co.uk</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Mr John Adams</p><p style="text-align: justify;">Sales Manager</p><p style="text-align: justify;">Berks Vehicle Service Plc  Our Ref: HR/me</p><p style="text-align: justify;">136 Bolt Road Your Ref: JA/ab</p><p style="text-align: justify;">Newbury</p><p style="text-align: justify;">Berks B29 073</p><p style="text-align: justify;">England                                                                                                               9 October 20__</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Dear Mr Adams</p><p style="text-align: justify;">Demonstration of SLX/34 Engine</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Thank you for letter of 5 October and the enclosed catalogue.</p><p style="text-align: justify;">We are very much interested in installing your engine in our buses, but some technical details remain unclear. Would it be possible for your representative to visit our factory at the above address and give a demonstration on either Thursday 19 or Friday 20 October at 2 p.m.?</p><p style="text-align: justify;">Looking forward to your reply</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Yours sincerely</p><p style="text-align: justify;">Helen Rees</p><p style="text-align: justify;">Administrative Manager</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Task 5. Translate into English.</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">1.	Компании продвигают свою торговую марку посредством рекламных кампаний.</p><p style="text-align: justify;">2.	Этот автомобиль – хорошее соотношение цены и качества. Его ценовой диапазон от $30,000 до $45,000.</p><p style="text-align: justify;">3.	Мы пишем это письмо, чтобы запросить цены на Ваше электронное оборудование.</p><p style="text-align: justify;">4.	Благодарим за Ваш утренний телефонный звонок, в котором Вы наводите справки по поводу Вашего заказа № 580.</p><p style="text-align: justify;">5.	С удовольствием сообщаем Вам, что вышеупомянутая компания всегда оплачивала наши счета вовремя.</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Критерии оценки письменной контрольной работы, предлагаемой в качестве текущего и промежуточного контроля в 3 семестре</p><p style="text-align: justify;">Знания, умения и навыки студента на зачете оцениваются (в баллах):</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Отлично	Хорошо	Удовлетворительно	Неудовлетворительно</p><p style="text-align: justify;">85-100	84-75	74-60	59 и ниже</p><p style="text-align: justify;"><br></p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Вариант устного задания, предлагаемого на экзамене на 1-3 семестрах</p><p style="text-align: justify;">Task 1</p><p style="text-align: justify;">Speak about enormous pay packages of CEOs and their performance. Comment on the case of GlaxoSmithKline. Use the material from Unit 4 Intelligent Business.</p><p style="text-align: justify;">Task 2</p><p style="text-align: justify;">Card 1</p><p style="text-align: justify;">Student A</p><p style="text-align: justify;">You are a business psychologist.</p><p style="text-align: justify;">Elizabeth works for a computer company. At first, she liked the job and believed that she could do it well. But now she has a problem: her team leader, Valma, is a bully.</p><p style="text-align: justify;">What should Elizabeth do?</p><p style="text-align: justify;">You know there are three main types of bully:</p><p style="text-align: justify;">A	Some bullies love power. They want to be in control of everything and everybody. These bullies make life difficult for all their subordinates. They usually have psychological problems and it isn\'t easy to change their management style.</p><p style="text-align: justify;">B	Some bullies hate mistakes. They want their own work be perfect and they want everyone else to be perfect too. These bullies don’t consider other people’ feelings when they find problem with their work. They often don’t know they are bullying. Sometimes it can help to talk to these bullies about their management style.</p><p style="text-align: justify;">C Some people become bullies because they are very unsure of themselves. They are afraid of competition from other people who may be better than them. They hate the idea of someone else doing well in their job. They think that the only way to improve their own success is to keep their competitors back.</p><p style="text-align: justify;">You are in favour of the following options:</p><p style="text-align: justify;">•	talk to her colleagues about it</p><p style="text-align: justify;">or, if it doesn’t help,</p><p style="text-align: justify;">•	report the bullying to a senior manager in the company.</p><p style="text-align: justify;">Talk to your colleague and decide on the best option for Elizabeth.</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Card 1</p><p style="text-align: justify;">Student B</p><p style="text-align: justify;">You are a business psychologist</p><p style="text-align: justify;">Elizabeth works for a computer company. At first, she liked the job and believed that she could do it well. But now she has a problem: her team leader, Valma, is a bully.</p><p style="text-align: justify;">What should Elizabeth do?</p><p style="text-align: justify;">You know there are three main types of bully:</p><p style="text-align: justify;">A	Some bullies love power. They want to be in control of everything and everybody. These bullies make life difficult for all their subordinates. They usually have psychological problems and it isn\'t easy to change their management style.</p><p style="text-align: justify;">B	Some bullies hate mistakes. They want their own work be perfect and they want everyone else to be perfect too. These bullies don’t consider other people’ feelings when they find problem with their work. They often don’t know they are bullying. Sometimes it can help to talk to these bullies about their management style.</p><p style="text-align: justify;">C Some people become bullies because they are very unsure of themselves. They are afraid of competition from other people who may be better than them. They hate the idea of someone else doing well in their job. They think that the only way to improve their own success is to keep their competitors back.</p><p style="text-align: justify;">You are in favour of the following options:</p><p style="text-align: justify;">•	talk to Valma herself</p><p style="text-align: justify;">or, if it doesn’t help,</p><p style="text-align: justify;">•	leave the job.</p><p style="text-align: justify;">Talk to your colleague and decide on the best option for Elizabeth.</p><p style="text-align: justify;">Критерии оценки устной части экзамена:</p><p style="text-align: justify;">за устную монологическую часть:</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Отлично	Хорошо	Удовлетворительно	Неудовлетворительно</p><p style="text-align: justify;">оценка «отлично» выставляется студенту, если ответ по теме билета не зачитывается, задание выполнено по определенному формату, соответствует выбранной теме, интересно и информативно, используется ключевая лексика, привлечен дополнительный материал, студент свободно и правильно отвечает на вопросы.	оценка «хорошо» выставляется студенту, если ответ по теме билета частично зачитывается, задание выполнено по определенному формату, соответствует выбранной теме, используется ключевая лексика, привлечен дополнительный материал, студент свободно и правильно отвечает на вопросы.</p><p style="text-align: justify;">оценка «удовлетворительно» выставляется студенту, если ответ по теме билета зачитывается, задание соответствует выбранной теме, но выполнено не по требуемому формату, используется ключевая лексика, не привлечен дополнительный материал и/или аудиовизуальные средства, студент испытывает трудности при ответах на вопросы.</p><p style="text-align: justify;">оценка «неудовлетворительно» студент не подготовил сообщение по теме билета.</p><p style="text-align: justify;"><br></p><p style="text-align: justify;"><br></p><p style="text-align: justify;">за устную часть по деловой проблеме (диалог):</p><p style="text-align: justify;"><br></p><p style="text-align: justify;">Отлично	Хорошо	Удовлетворительно	Неудовлетворительно</p><p style="text-align: justify;">оценка «отлично» выставляется студенту, если он свободно владеет лексикой, понимает собеседника, грамматически правильно выстраивает предложения, предлагает решение проблемы.	оценка «хорошо» выставляется студенту, если он владеет лексикой, понимает собеседника, отвечает краткими предложениями.</p><p style="text-align: justify;">оценка «удовлетворительно» выставляется студенту, если он слабо владеет лексикой, не полностью понимает собеседника, не принимает участие в поиске решения.</p><p style="text-align: justify;">оценка «неудовлетворительно» выставляется студенту, если он не владеет лексикой, не понимает собеседника, не участвует в обсуждении.</p><p style="text-align: justify;"><br></p><p style="text-align: justify;"><br></p><p style="text-align: justify;"><span class="e-editor-select-end"></span></p>';


//$html.='<p style="text-indent: 1.25cm; text-align: justify;">Прошу Вас разрешить въезд на территорию и парковку автомобиля ';
//$html.=$ret['car_mark'];
//$html.=' ';
//$html.=$ret['car_model'];
//$html.=', государственный регистрационный знак <strong>';
//$html.=strtolower($ret['car_plate']);
//$html.='</strong>';
//$html.=' на период с ';
//$html.=$ret['date_from']->format('d.m.Y H:i');
//$html.=' по ';
//$html.=$ret['date_to']->format('d.m.Y H:i');
//$html.='.</p>';
//$html.='<p style="text-indent: 1.25cm; text-align: justify;">С правилами использования парковки ознакомлен и согласен.</p>';
//$html.='<p style="text-indent: 1.25cm; text-align: justify;">Оплату обязуюсь произвести не позднее ';
//$c=new DateTime($ret['date_from']->format('c'));
//$c->sub(DateInterval::createFromDateString('6 days'));
//$html.=$c->format('d.m.Y');
$html .= "</p>";
//$html.="<br><br><p></p>";
//$html.="<br><br><p></p>";
//$html.="<br><br><p></p>";
//$html.="<br><br> ";
//$html.="<br><br> ";
//$html.="<br><br> ";
$html .= '<table ><tr><td style="text-align: right; : 5cm;">';
//$html.=$ret['date_curr']->format('d.m.Y');
$html .= '</td><td style=": 9cm;">';
$html .= '&nbsp;';
$html .= '</td><td style="text-align: left;">';
//$html.=$ret['user']['declination']['КраткоеИОФИП'];
$html .= '</td></tr></table>';
//print $html;
//---------------------------------------------------


class MYPDF extends TCPDF
{

    public function __construct($orientation = 'P', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = 'UTF-8', $diskcache = false, $pdfa = false, $pageNumbers = true)
    {
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);
        $this->fontname1 = TCPDF_FONTS::addTTFfont(__DIR__ . '/../ankets/include/ttf/PT/PT-Sans/PT-Sans_Bold.ttf', 'TrueTypeUnicode', '', 96);
        $this->fontname2 = TCPDF_FONTS::addTTFfont(__DIR__ . '/../ankets/include/ttf/PT/PT-Sans/PT-Sans_Italic.ttf', 'TrueTypeUnicode', '', 96);
        $this->fontname = TCPDF_FONTS::addTTFfont(__DIR__ . '/../ankets/include/ttf/PT/PT-Sans/PT-Sans_Regular.ttf', 'TrueTypeUnicode', '', 96);

        $this->setPDFVersion("1.4");
        $this->SetMargins(30, 10, 10);
        $this->SetAutoPageBreak(TRUE, 30);
//$pdf->SetCellPadding(0);
        $this->pageNumbers = $pageNumbers;


        $this->SetFont($this->fontname1, '', 12);
        $this->SetFont($this->fontname2, '', 12);
        $this->SetFont($this->fontname, '', 12);


    }

    protected $last_page_flag = false;

    public function Close()
    {
        $this->last_page_flag = true;
        parent::Close();
    }

    //Page header
    public function Header()
    {
        // Logo
        //  $image_file = K_PATH_IMAGES.'logo_example.jpg';
        //  $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        //  $this->SetFont('helvetica', 'B', 20);
        // Title
        //  $this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer()
    {
        global $USER;
        global $config;

        // Position at 15 mm from bottom
        $this->SetY(-15);
//        var_dump($this);
        // Set font
        // $this->SetMargins(0,0,0);
        //  $fontname = TCPDF_FONTS::addTTFfont(__DIR__.'/../../../include/ttf/PT/PT-Sans/PT-Sans_Regular.ttf', 'TrueTypeUnicode', '', 96);

// use the font
        $this->SetFont($this->fontname, '', 8, '', false);
        // $this->SetFont('helvetica', 'I', 8);
        // Page number
        // $tpages = $this->getAliasNbPages();
        // $page = $this->getAliasNumPage();

        $page = $this->PageNo();
        $tpages = $this->getNumPages();

        //var_dump($tpages);
        //var_dump($page);

        // $page='1';
        // $tpages='1';

        $txt = '<table ="100%" style="position: absolute">
                <tr><td style="text-align: center;
                               
                                font-size: 12pt;">';
        if ($this->page == 1) {
            $txt .= $this->page1footerhtml;
        } else {
            $txt .= trim($page);
        };

//        $txt.='<tr><td style="text-align: center; font-size: 6pt;">';
//
//        if ($this->last_page_flag)
//        {
//         //   $fullname=$USER->GetFullName();
//         //   $txt.="Исполнитель ".$fullname.'[bx'.$USER->GetID().']';
//            // $this->Cell(0, 8, $txt, 1, true, 'L', 0, '', 0, false, 'T', 'M');
//            //$this->MultiCell(0,0,$txt,1,'L',false,1,'','','','',true);
//        }
//        $txt.='</td><td style="text-align: right; margin-right: 0;">';
//        if ($page<>1) {
//            $txt .= trim($page);
//        }
        $txt .= '</td></tr></table>';
        //       $this->Cell(0, 8, $txt, 0, true, 'R', 0, '', 0, false, 'T', 'M');
        //$this->MultiCell(0,0,$txt,1,'R',false,1,'','','','',true);
        $this->writeHTML($txt, true, false, true, false, 'C');

//        $session = \Bitrix\Main\Application::getInstance()->getSession();
//        $edoc_id=$session->get($config['document_type']);

//        $url='https://'.$_SERVER['SERVER_NAME'].'/doc/getDoc.php?id='.$edoc_id;
//
//        $style = array(
//            'border' => false,
//            'padding' => 0,
//            'fgcolor' => array(0,0,100),
//            'bgcolor' => false
//        );
//
//
//        $this->write2DBarcode($url, 'QRCODE,Q', 5, 270, 20, 20, $style, 'N');
//        $this->Link(5, 270, 20, 25,$url);
//        $this->SetFont($this->fontname, 'B', 5);
//        $this->SetTextColor(0, 0, 100);
//
//        if (preg_match("/(\d{4})(\d{4})(\d{4})(\d{4})(\d{4})/",$edoc_id,$m))
//        {
//            unset($m[0]);
//            $edoc_id=implode('-',$m);
//        }
//        //    var_dump($m);

//        $this->MultiCell(22, 10, $edoc_id,0,'C',0,0,4,290);

    }
}


//$html = <<<EOD
//<h1>Добро пожаловать в <span style="background-color:#CC0000;color:black;">TC</span><span style="background-color:#CC0000;color:white;">PDF</span>!</h1>
//<i>Это пример работы библиотеки TCPDF.</i>
//<p>Этот текст печатается с использованием метода <i>writeHTMLCell()</i>, но вы также можете использовать: <i>Multicell(), writeHTML(), Write(), Cell() и Text()</i>.</p>
//<p>Пожалуйста, ознакомьтесь с документацией по исходному коду и другими примерами для получения дополнительной информации.</p>
//EOD;

$fn = tempnam('/tmp/upload', 'sl7_');
ob_end_clean();
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->page1footerhtml = $page1footerhtml;
//// Устанавливаем автоматические разрывы страниц
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//// Устанавливаем отступы
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);


$pdf->AddPage();                    // pretty self-explanatory
$pdf->PageNo();


//$pdf->writeHTML($html, true, false, true, false, '');
//
//$pdf->AddPage();                    // pretty self-explanatory

$pdf->writeHTML($html, true, false, true, false, '');
//$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
//$pdf->Output($ret['z_id'].'.pdf','F');    // send the file inline to the browser (default).
//$pdf->Output($fn,'F');    // send the file inline to the browser (default).
//$pdf->lastPage();

//$pdf->Output($fn,'I');    // send the file inline to the browser (default).

$fileName =  $json['static']['disciplineIndex'] . '_' . \date('d-m-Y', \strtotime($json['static']['syllabusData']['year'])) . '.pdf';
$path = $_SERVER['DOCUMENT_ROOT'] . 'oplyuyko_test/rpd/' . $fileName;
$link = '/oplyuyko_test/rpd/'. $fileName;
$pdf->Output($path, 'F');

die(\json_encode(['link' => $link], JSON_UNESCAPED_UNICODE));

$state = array(
    'edoctype' => 7,
    'adddoctitle' => 'СИнеЛЬниКОв',
    'filename' => $fn,
    'stamp-x' => 150,
    'stamp-y' => 200,
);

//define("NOT_CHECK_PERMISSIONS", true);
//define("BX_BUFFER_USED", true);
//require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->AddHeadString('<script src="../include/js/jquery-3.5.1.min.js"></script>', true);


$_SESSION['state'] = $state;


//$APPLICATION->AddHeadString('<script src="../include/js/jquery-3.5.1.min.js"></script>', true);
?>
    <script>
      BX.ready(function () {
        window.location.replace("/doc/sign/signpdf.php");
      });

    </script>
<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");

//print $html;


//print "<hr><pre>";
//
//print json_encode($ret,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
//print "</pre><hr>";

//var_dump($_POST);
