<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ivanov_sv
 * Date: 19.03.13
 * Time: 17:58
 * To change this template use File | Settings | File Templates.
 */
require "../DateParser.php";
/**
 * Class DateParserTest
 */
class DateParserTest extends PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function setUp()
    {
        $this->parser = new DateParser();
    }

    /**
     * @return array
     */
    public function provider()
    {
        return array(
            array("60лет", 636), //1
            array("12 лет", 144), //2
            array("12года", 144), //3
            array("1993", 240), //4
            array("98 года", 180), //5
            array("5месяцев", 5), //6
            array("12 месяцев", 12), //7
            array("01.01.1985", 338), //8
            array("1.1.2010", 38), //9
            array("1.01.10", 38), //10
            array("1.01.93", 242), //11
//              array("с 1998года",), //12
//              array("с января 1998 года",), //13
//              array("с февраля 1998 года",), //14
//              array("с марта 1998 года",), //15
//              array("с апреля 1998 года",), //16
//              array("с мая 1998 года",), //17
//              array("с июня 1998 года",), //18
//              array("с июля 1998 года",), //19
//              array("с августа 1998 года",), //20
//              array("с сентября 1998года",), //21
//              array("с ноября 1998года",), //22
//              array("с декабря 1998года",), //23
//              array("с 19 августа 1998 года",), //24
//              array("с 19 августа 1998года",), //25
//              array("с августа 1998года",), //26
//              array("с августа 98года",), //27
//              array("с августа98года",), //28
//              array("с 98года",), //29
//              array("с98года",), //30
//              array("с19августа1998года",), //31
//              array("савгуста 1998года",), //32
//              array("савгуста1998года",), //33
            array("с 1998 года", 180), //34
            array("15", 15), //35
            array("60", 60) //36
        );
    }

    /**
     * @dataProvider provider
     */
    public function testParseDataToMonths($a, $b)
    {
        $this->parser->setDate($a);
        $this->assertEquals($b, $this->parser->parse());


    }

    /**
     *
     */
    public function testSome()
    {

    }
}
