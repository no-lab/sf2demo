<?php

namespace BackOfficeBundle\Tests\Utils;

use BackOfficeBundle\Utils\EmailPlanner;

class EmailPlannerTest extends \PHPUnit_Framework_TestCase
{
    public function testHolidays()
    {
        $timer = new EmailPlanner(new \DateTime('2015-11-07 11:14:15'));

        $this->assertEquals($timer->isHoliday(new \DateTime('2015-12-25 11:14:15')), true);
        $this->assertEquals($timer->isHoliday(new \DateTime('2015-12-01 11:14:15')), false);
    }

    public function testWeekend()
    {
        $timer = new EmailPlanner(new \DateTime('2015-11-07 11:14:15'));

        $this->assertEquals($timer->isWeekend(new \DateTime('2015-11-07 11:14:15')), true);
        $this->assertEquals($timer->isWeekend(new \DateTime('2015-11-06 11:14:15')), false);
    }

    public function testBeforeMorning()
    {
        $timer = new EmailPlanner(new \DateTime('2015-11-07 11:14:15'));

        $this->assertEquals($timer->isBeforeBusinessMorning(new \DateTime('2015-11-07 04:14:15')), false);
        $this->assertEquals($timer->isBeforeBusinessMorning(new \DateTime('2015-11-06 04:14:15')), true);
    }

    public function testMorning()
    {
        $timer = new EmailPlanner(new \DateTime('2015-11-07 11:14:15'));

        $this->assertEquals($timer->isBusinessMorning(new \DateTime('2015-11-07 11:14:15')), false);
        $this->assertEquals($timer->isBusinessMorning(new \DateTime('2015-11-06 11:14:15')), true);
    }

    public function testResults()
    {
        $timer = new EmailPlanner(new \DateTime('2015-11-12 09:00:0'));
        $this->assertEquals($timer->findAvailableTime(), new \DateTime('2015-11-12 14:30:00'));

        $timer = new EmailPlanner(new \DateTime('2015-11-12 00:14:15'));
        $this->assertEquals($timer->findAvailableTime(), new \DateTime('2015-11-12 14:30:00'));
    }
}
