<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ivanov_sv
 * Date: 13.03.13
 * Time: 14:15
 * To change this template use File | Settings | File Templates.
 */
echo "Hello World";
$dataProvider = array(
    "12лет",
    "12 лет",
    "12года",
    "15 года",
    "5месяцев",
    "12 месяцев",
    "01.01.2000",
    "1.01.2010",
    "1.01.10",
    "1.01.00",
    "с 1998года",
    "с 1998 года"
);
//echo strtotime("01.01.2000");
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
    $pattern_years = "/(^|\s|[A-zА-я])(\d\d\d?\d?)(\s?)(лет|года|год)/";
    $pattern_months = "/(\d\d?)(\s?)(месяцев)/";
    $pattern_date = "/(\d\d?)(\.|\,)(\d\d?)(\.|\,)(\d\d\d?\d?)/";

    if (preg_match($pattern_years, $date, $matches)) {
        echo "$date ---- Лет: ";
        print_r($matches);
        if ($matches[2] > 99) {
            $year = date("Y") - $matches[2];
        } else {
            $year = date("Y") - (2000 + $matches[2]);
        }
        $months = $year * 12;
        print_r($months);
        echo "<br>";
    }

    if (preg_match($pattern_months, $date, $matches)) {
        echo "$date ---- Месяцев: ";
        print_r($matches[1]);
        echo "<br>";
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
        echo "$date ---- Date: ";
        print_r($months);
        echo "<br>";
    }
}

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
