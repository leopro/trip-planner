<?php

namespace Leopro\TripPlanner\Domain\Tests;

use Leopro\TripPlanner\Domain\Entity\Route;

class RouteTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateTripReturnsATripWithFirstRoute()
    {
        $route = Route::create('my first trip');
        $route->addLeg('06/06/2014');
        $route->addLeg('06/06/2014');

        $this->assertEquals(1, $route->getLegs()->count());

        $route->addLeg('07/06/2014');
        $this->assertEquals(2, $route->getLegs()->count());
    }
} 