<?php

namespace BackOfficeBundle\Tests\Utils;

use BackOfficeBundle\Utils\EmailPlanner;

class EmailPlannerTest extends \PHPUnit_Framework_TestCase
{

    public function testWeekend()
    {
        $timer = new EmailPlanner(new \DateTime('2015-11-07 11:14:15'));

        $this->assertEquals($timer->isWeekend(new \DateTime('2015-11-07 11:14:15')), true);
        $this->assertEquals($timer->isWeekend(new \DateTime('2015-11-06 11:14:15')), false);
    }

    public function testResults()
    {
        $timer = new EmailPlanner(new \DateTime('2015-11-12 00:14:15'));
    }
}
