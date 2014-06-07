<?php

namespace Leopro\TripPlanner\Domain\Tests;

use Leopro\TripPlanner\Domain\Entity\Trip;

class TripTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateTripReturnATripWithFirstRoute()
    {
        $trip = Trip::create('my first planning');
        $this->assertInstanceOf('Leopro\TripPlanner\Domain\Entity\Trip', $trip);
        $this->assertEquals(1, $trip->getRoutes()->count());
    }
} 