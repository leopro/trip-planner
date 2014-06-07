<?php

namespace Leopro\TripPlanner\Domain\Tests;

use Leopro\TripPlanner\Domain\ValueObject\Date;

class DateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     */
    public function testDateReturnsFormattedDate($input, $formatInput, $formatOutput, $expected)
    {
        $date = new Date($input, $formatInput);

        $this->assertEquals($expected, $date->getFormattedDate($formatOutput));
    }

    public function provider()
    {
        return array(
            array('2014-6-1', 'Y-m-d', 'Y-m-d', '2014-06-01'),
            array('1-6-2014', 'd-m-Y', 'Y-m-d', '2014-06-01'),
            array('2014-6-1', 'Y-m-d', 'd-m-Y', '01-06-2014'),
        );
    }
} 