<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ivanov_sv
 * Date: 13.03.13
 * Time: 14:15
 * To change this template use File | Settings | File Templates.
 */
require "DateParser.php";
//TODO fix for date 28, 30, 31, 33
echo "Hello World";
$dataProvider = array(
    "60лет", //1
    "12 лет", //2
    "12года", //3
    "15 года", //4
    "98 года", //5
    "5месяцев", //6
    "12 месяцев", //7
    "01.01.1985", //8
    "1.1.2010", //9
    "1.01.10", //10
    "1.01.93", //11
    "с 1998года", //12
    "с января 1998 года", //13
    "с февраля 1998 года", //14
    "с марта 1998 года", //15
    "с апреля 1998 года", //16
    "с мая 1998 года", //17
    "с июня 1998 года", //18
    "с июля 1998 года", //19
    "с августа 1998 года", //20
    "с сентября 1998года", //21
    "с ноября 1998года", //22
    "с декабря 1998года", //23
    "с 19 августа 1998 года", //24
    "с 19 августа 1998года", //25
    "с августа 1998года", //26
    "с августа 98года", //27
    "с августа98года", //28
    "с 98года", //29
    "с98года", //30
    "с19августа1998года", //31
    "савгуста 1998года", //32
    "савгуста1998года", //33
    "с 1998 года", //34
    "15", //35
    "60" //36
);

$parser = new DateParser();
foreach ($dataProvider as $date) {
    $parser->setDate($date);
    echo "$date --- ";
    echo $parser->parse(), "<br>";
    echo $parser->getYears(), "<br>";
}


/*$months_array = array(
    "январь" => 1,
    "января" => 1,
    "февраль" => 2,
    "февраля" => 2,
    "март" => 3,
    "апреля" => 4,
    "апрель" => 4,
    "май" => 5,
    "мая" => 5,
    "июнь" => 6,
    "июня" => 6,
    "июль" => 7,
    "июля" => 7,
    "август" => 8,
    "сентябрь" => 9,
    "сентября" => 9,
    "октябрь" => 10,
    "октября" => 10,
    "ноябрь" => 11,
    "ноября" => 11,
    "декабрь" => 12,
    "декабря" => 12
);


foreach ($dataProvider as $field) {

}


$dataProvider2 = array("02.02.2000", "05.12.1998", "5.1.95");
foreach ($dataProvider2 as $date) {
    echo strtotime((string)$date);
    echo "<br>";
}


echo "<pre>";
printf($dataProvider);
echo "</pre>";
$i = 0;
foreach ($dataProvider as $date) {
    echo "[", ++$i, "]";
    $date_month = "";
    $pattern_years = "/(^|\s|^\s?[A-zА-я]?\s?)(\d\d\d?\d?)(\s?)(лет|года|год)/";
    $pattern_months = "/(\d\d?)(\s?)(месяца|месяцев)/";
    $pattern_date = "/(\d\d?)(\.|\,)(\d\d?)(\.|\,)(\d\d\d?\d?)/";
    $pattern_onlyDigit = "/(^|\s)(\d+)($|\s)/";

    foreach ($months_array as $month_str => $month_int) {
        if (strpos($date, $month_str)) {
            $date_month = $month_int;
            break;
        }
    }

    if (preg_match($pattern_years, $date, $matches)) {
        echo "$date ---- Месяцев: ";
        //print_r($matches);
        if ($matches[2] > (date("Y") + 10 - 2000)) {
            if ($matches[2] > 99) {
                $year = date("Y") - $matches[2];
            } else {
                $year = date("Y") - (1900 + $matches[2]);
            }
        } elseif ($matches[2] < (date("Y") + 10 - 2000)) {
            $year = date("Y") - (2000 + $matches[2]);
        }
        $months = $year * 12;
        if (preg_match("/(^\s?[A-zА-я]+\s?)(\d\d?)(\s?)(лет|год|года)($|\s$)/", $date, $matche)) {
            print_r($matche);
            echo "V";
            $months = $matche[2] * 12;
        }

        if (!empty($date_month)) {
            $m_diff = date("m") - $date_month;
            $months += $m_diff;
        }
        echo date("Y") + 10 - 2000;
        $months = abs($months);
        print_r($matches);
        print_r($months);
        echo "<br>";
        continue;
    }

    if (preg_match($pattern_months, $date, $matches)) {
        echo "$date ---- Месяцев: ";
        print_r($matches[1]);
        echo "<br>";
        continue;
    }

    if (preg_match($pattern_date, $date, $matches)) {
        //list($matches[1], $matches[3], $matches[5]) = explode(".", $birthday);
        if ($matches[5] < 30 && preg_match("/(\d\d)/", $matches[5])) {
            $year = 2000 + $matches[5];
        } elseif (preg_match("/^(\d\d)$/", $matches[5])) {
            $year = 1900 + $matches[5];
        } else {
            $year = $matches[5];
        }
        $year_diff = date("Y") - $year;
        $month_diff = date("m") - $matches[3];
        $day_diff = date("d") - $matches[1];
        $months = $year_diff * 12 + $month_diff;
        echo "$date ---- Месяцев: ";
        print_r($months);
        echo "<br>";
        continue;
    }

    if (preg_match($pattern_onlyDigit, $date, $matches)) {
        echo "$date ---- Месяцев: ";
        $months = $matches[2];
        echo $months, "<br>";
        continue;
    }
}*/

/*$date1 = new DateTime("2007-03-24");
$date2 = new DateTime("2009-06-26");
$interval = $date1->diff($date2);
echo "difference " . $interval->y . " years, " . $interval->m." months, ".$interval->d." days ";

foreach ($dataProvider as $date) {
    echo $date/12,"<br>";
}

/*$parser = new DateParser();
$date = "9лет";
echo $date;
$parser->addDate($date);
$parser->toMonths();
echo $parser->output();*/
