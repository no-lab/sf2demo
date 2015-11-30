<?php

/*
 * Ics file parser
 *
 * Really simple (and dirty)
 * Should probably NOT used in production
 *
 * ICS source : http://www.kayaposoft.com/enrico/ics/v1.0?country=bel&fromDate=01-01-2014&toDate=31-12-2016&en=1
 */

namespace BackOfficeBundle\Utils;

class ICalSimpleParser
{
    public function __construct($file)
    {
        $this->loadFile($file);
    }

    protected function loadFile($file)
    {
        $myFile = fopen($file, 'r') or die('Unable to open file!');
        $this->data = fread($myFile, filesize($file));
        fclose($myFile);
    }

    protected function convertDate($str) {
        preg_match('/DTSTART;VALUE=DATE:([0-9]{8})/', $str, $r);
        $startDate = \DateTime::createFromFormat('Ymd', $r[1]);

        preg_match('/DTEND;VALUE=DATE:([0-9]{8})/', $str, $r);
        $endDate = \DateTime::createFromFormat('Ymd', $r[1]);

        if ($endDate->diff($startDate)->format('%d') > 1) {
            throw new Exception('Invalid period');
        }

        return $startDate;
    }

    public function extract()
    {
        $dates = array();

        preg_match_all('/DTSTART.*\nDTEND.*/', $this->data, $results);

        foreach ($results as $result) {
            foreach ($result as $line) {
                $dates[] = $this->convertDate($line)->format('Y-m-d');
            }
        }

        return $dates;
    }
}
