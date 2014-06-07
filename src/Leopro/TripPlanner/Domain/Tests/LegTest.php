<?php

namespace Leopro\TripPlanner\Domain\Tests;

use Leopro\TripPlanner\Domain\Entity\Leg;

class LegTest extends \PHPUnit_Framework_TestCase
{
    public function testDistance()
    {
        $leg = Leg::create('01/01/2014', 'd/m/Y', -3.386665, 36.736908);

        $this->assertInstanceOf('Leopro\TripPlanner\Domain\Entity\Leg', $leg);

        $location = $leg->getLocation();
        $this->assertInstanceOf('Leopro\TripPlanner\Domain\Entity\Location', $location);

        $point = $location->getPoint();
        $this->assertInstanceOf('Leopro\TripPlanner\Domain\ValueObject\Point', $point);
        $this->assertEquals(-3.386665, $point->getLatitude());
        $this->assertEquals(36.736908, $point->getLongitude());
    }
} 