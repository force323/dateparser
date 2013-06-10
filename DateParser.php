<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ivanov_sv
 * Date: 13.03.13
 * Time: 14:16
 * To change this template use File | Settings | File Templates.
 */

class DateParser
{
    private $date;
    private $pattern_years = "/(^|\s|^\s?[A-zА-я]+\s?)(\d\d\d?\d?)(\s?)(лет|года|год)/";
    private $pattern_months = "/(\d\d?)(\s?)(месяца|месяцев)/";
    private $pattern_date = "/(\d\d?)(\.|\,)(\d\d?)(\.|\,)(\d\d\d?\d?)/";
    private $pattern_onlyDigit = "/(^|\s)(\d+)($|\s$)/";
    private $months_array = array(
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
    private $years;
    private $months;
    // private $month_str;
    private $yearNow;
    private $monthNow;
    private $date_month;

    function __construct($date = "")
    {
        date_default_timezone_set("Asia/Dubai");
        $this->monthNow = date("m");
        $this->yearNow = date("Y");
        $this->date = $date;
    }

    public function parse()
    {
        // WTF?! big shit
        // TODO refactor
        if (!empty($this->date)) {
            if (!$this->digitToMonths()) {
                if (!$this->yearsToMonths()) {
                    if (!$this->dateToMonths()) {
                        if (!$this->monthStrToInt()) {
                            if (!$this->monthsToMonths()) {
                                throw new Exception("Something wrong");
                            } else {
                                $this->years = $this->months / 12;
                                return $this->months;
                            }
                        } else {
                            $this->years = $this->months / 12;
                            return $this->months;
                        }
                    } else {
                        $this->years = $this->months / 12;
                        return $this->months;
                    }
                } else {
                    $this->years = $this->months / 12;
                    return $this->months;
                }
            } else {
                $this->years = $this->months / 12;
                return $this->months;
            }

        } else {
            throw new Exception("String for parse is empty");
        }
    }

    public function digitToMonths()
    {
        if (preg_match($this->pattern_onlyDigit, $this->date, $matches)) {

            if ($matches[2] < 1800) {
                $this->months = $matches[2];
                return $matches[2];
            } elseif ($matches[2] >= 1800) {
                $this->months = ($this->yearNow - $matches[2]) * 12;
                return $this->months;
            }
        }
        return false;
    }

    public function yearsToMonths()
    {
        // TODO refactor
        // rename, add const
        $this->date_month = $this->monthStrToInt();
        if (preg_match($this->pattern_years, $this->date, $matches)) {
            if ($matches[2] > ($this->yearNow + 10 - 2000)) {
                if ($matches[2] > 99) {
                    $year = $this->yearNow - $matches[2];
                } else {
                    $year = $this->yearNow - (1900 + $matches[2]);
                }
            } elseif ($matches[2] < ($this->yearNow + 10 - 2000)) {
                $year = $this->yearNow - (2000 + $matches[2]);
            }

            $months = $year * 12;
            echo "$year";
            echo "$months";
            if (preg_match("/(^\s?[A-zА-я]?\s?)(\d\d?)(\s?)(лет|год|года)($|\s$)/", $this->date, $matche) && $matches[2] < ($this->yearNow + 10 - 2000)) {
                $months = $matche[2] * 12;
            }

            if ($this->date_month) {
                $m_diff = $this->monthNow - $this->date_month;
                $months += $m_diff;

            }
            $this->months = $months;
            return $months;
        }
        return false;
    }

    public function monthStrToInt()
    {
        foreach ($this->months_array as $month_str => $month_int) {
            if (strpos($this->date, $month_str)) {
                $this->months = $month_int;
                return $month_int;
            }
        }
        return false;
    }

    public function dateToMonths()
    {
        if (preg_match($this->pattern_date, $this->date, $matches)) {

            if ($matches[5] < 30 && preg_match("/(\d\d)/", $matches[5])) {
                $year = 2000 + $matches[5];
            } elseif (preg_match("/^(\d\d)$/", $matches[5])) {
                $year = 1900 + $matches[5];
            } else {
                $year = $matches[5];
            }
            $year_diff = $this->yearNow - $year;
            $month_diff = $this->monthNow - $matches[3];
            //$day_diff = date("d") - $matches[1];
            $months = $year_diff * 12 + $month_diff;
            $this->months = $months;
            return $months;
        }
        return false;
    }

    public function monthsToMonths()
    {
        if (preg_match($this->pattern_months, $this->date, $matches)) {
            $this->months = $matches[1];
            return $matches[1];
        }
        return false;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getYears()
    {
        return $this->years;
    }
}
