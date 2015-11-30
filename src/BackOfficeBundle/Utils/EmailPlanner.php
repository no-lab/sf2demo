<?php
/*
 * Email Planner
 *
 * Find the time an email will be sent (4 business hours after the approval)
 *
 * Conditions on the time the email is sent:
 *  - Email can only be sent during these business hours (9:00 to 12:00, and
 *    13:30 to 17:00)
 *  - Email cannot be sent on Mondays between 9:00 and 12:00; nor on Fridays
 *    between 13:30 and 17:00
 *  - Email cannot be sent during holidays period (ical format calendar).
 *
 * For example, an invoice approved at 9am will be sent at 14:30 (9-12 = 3
 * business hours, 13:30 to 14:30 = 1 business hour)
 */

namespace BackOfficeBundle\Utils;

use BackOfficeBundle\Utils\ICalSimpleParser;

date_default_timezone_set('UTC');

class EmailPlanner
{
    private $targetInterval = 14400;  // 4 hours
    private $currentInterval = 0;

    public function __construct($date)
    {
        $this->endDate = $date;

        $iCalParser = new ICalSimpleParser(__DIR__ . '/../../../app/Resources/calendar.ics');
        $this->holidays = $iCalParser->extract();
    }

    public function isHoliday($date)
    {
        if (in_array($date->format('Y-m-d'), $this->holidays)) {
            return true;
        }
        return false;
    }

    public function handleHoliday() {
        if ($this->isHoliday($this->endDate)) {
            $this->gotoNextDay();
        }
    }

    public function isWeekend($date)
    {
        $day = $date->format('N');
        if ($day > 5) {
            return true;
        }
        return false;
    }

    public function handleWeekend()
    {
        if ($this->isWeekend($this->endDate)) {
            $this->gotoNextDay();
        }
    }

    public function isBusinessMorning($date)
    {
        $day = $date->format('N');
        $hour = $date->format('H');

        if ($hour >= 9 && $hour < 12 && $day > 1 && $day < 5) {
            return true;
        }
        return false;
    }

    public function isBeforeBusinessMorning($date)
    {
        $day = $date->format('N');
        $hour = $date->format('H');

        if ($hour < 9 && $day > 1 && $day < 5) {
            return true;
        }
        return false;
    }

    public function handleMorning()
    {
        if ($this->isBusinessMorning($this->endDate)) {
            $l = clone $this->endDate;
            $l->setTime(12, 0, 0);

            $availableInterval = $l->getTimestamp() - $this->endDate->getTimestamp();
            $interval = $this->calculateInterval($this->targetInterval, $this->currentInterval, $availableInterval);
            $this->currentInterval += $interval;

            if ($this->currentInterval < $this->targetInterval) {
                $this->endDate->setTime(13, 30, 0);
            } else {
                $this->endDate->add(new \DateInterval('PT'.$interval.'S'));
            }
        }
        elseif ($this->isBeforeBusinessMorning($this->endDate)) {
            $this->endDate->setTime(9, 0, 0);
        }
        else {
            $this->endDate->setTime(13, 30, 0);
        }
    }

    public function isBusinessAfternoon($date)
    {
        $day = $date->format('N');
        $hour = $date->format('H');
        $minute = $date->format('i');

        if ($hour >= 13 && $hour < 17 && $day < 5) {
            if ($hour == 13 && $minute < 30) {
                return false;
            }
            return true;
        }
        return false;
    }

    public function isAfterBusinessAfternoon($date)
    {
        $day = $date->format('N');
        $hour = $date->format('H');

        if (($hour > 17 && $day < 5) || $day == 5)  {
            return true;
        }
        return false;
    }

    public function handleAfternoon()
    {
        if ($this->isBusinessAfternoon($this->endDate)) {
            $l = clone $this->endDate;
            $l->setTime(17, 0, 0);

            $availableInterval = $l->getTimestamp() - $this->endDate->getTimestamp();
            $interval = $this->calculateInterval($this->targetInterval, $this->currentInterval, $availableInterval);
            $this->currentInterval += $interval;
            if ($this->currentInterval < $this->targetInterval) {
                $this->gotoNextDay();
            } else {
                $this->endDate->add(new \DateInterval('PT'.$interval.'S'));
            }
        } elseif ($this->isAfterBusinessAfternoon($this->endDate)) {
            $this->gotoNextDay();
        }
    }

    public function calculateInterval($target, $current, $available)
    {
        if ($current + $available > $target) {
            return $target - $current;
        } else {
            return $available;
        }
    }

    public function findAvailableTime()
    {
        $checkFunctions = array('Holiday', 'Weekend', 'Morning', 'Afternoon');

        while ($this->currentInterval != $this->targetInterval) {
            foreach($checkFunctions as $checkFunction) {
                call_user_func(array($this, 'handle' . $checkFunction));
                if ($this->currentInterval === $this->targetInterval) break;
            }
        }

        return $this->endDate;
    }

    private function gotoNextDay()
    {
        $this->endDate->add(new \DateInterval('P1D'));
        $this->endDate->setTime(9, 0, 0);
    }
}
