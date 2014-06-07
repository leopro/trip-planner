<?php

namespace Leopro\TripPlanner\Domain\Tests;

use Leopro\TripPlanner\Domain\Entity\Trip;
use Leopro\TripPlanner\Domain\ValueObject\TripIdentity;

class TripTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateTripReturnsATripWithFirstRoute()
    {
        $trip = Trip::create(new TripIdentity(1), 'my first planning');
        $this->assertInstanceOf('Leopro\TripPlanner\Domain\Entity\Trip', $trip);
        $this->assertEquals(1, $trip->getRoutes()->count());
        $this->assertInstanceOf('Leopro\TripPlanner\Domain\Entity\Route', $trip->getRoutes()->first());
        $this->assertEquals('first route for trip: my first planning', $trip->getRoutes()->first()->getName());
    }
} 