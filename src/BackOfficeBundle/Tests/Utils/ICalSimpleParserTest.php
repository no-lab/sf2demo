<?php

namespace BackOfficeBundle\Tests\Utils;

use BackOfficeBundle\Utils\ICalSimpleParser;

class IcalSimpleParserTest extends \PHPUnit_Framework_TestCase
{
    private $calendarPath = '/../../../../app/Resources/calendar.ics';

    public function __construct()
    {
        $this->calendarFile = __DIR__ . $this->calendarPath;
    }

    public function testParse()
    {
        $parser = new ICalSimpleParser($this->calendarFile);
        $dates = $parser->extract();
        $this->assertEquals(count($dates), 174);
    }

    public function testResults()
    {
        $parser = new ICalSimpleParser($this->calendarFile);
        $dates = $parser->extract();

        $this->assertEquals(in_array('2015-12-25', $dates), true);
        $this->assertEquals(in_array('2015-12-01', $dates), false);
    }
}
