<?php

namespace Leopro\TripPlanner\Application\Tests;

use Leopro\TripPlanner\Application\Command\AddLegToRouteCommand;
use Leopro\TripPlanner\Application\UseCase\AddLegToRouteUseCase;
use Leopro\TripPlanner\Domain\Entity\Route;
use Leopro\TripPlanner\Domain\Entity\Trip;
use Leopro\TripPlanner\Domain\ValueObject\TripIdentity;

class AddLegToRouteTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateTrip()
    {
        $trip = Trip::createWithFirstRoute(new TripIdentity(1), 'my first planning');
        $this->assertEquals(0, $trip->getRoute(null)->getLegs()->count());

        $tripRepository = $this->getMockBuilder('Leopro\TripPlanner\Domain\Contract\TripRepository')
            ->disableOriginalConstructor()
            ->getMock();

        $tripRepository
            ->expects($this->once())
            ->method('get')
            ->will($this->returnValue($trip));

        $tripRepository
            ->expects($this->once())
            ->method('add');

        $command = new AddLegToRouteCommand('abcde', null, '01/01/2014', 'd/m/Y', -3.386665, 36.736908);
        $useCase = new AddLegToRouteUseCase($tripRepository);

        $trip = $useCase->run($command);

        $this->assertInstanceOf('Leopro\TripPlanner\Domain\Entity\Trip', $trip);
        $this->assertEquals(1, $trip->getRoute(null)->getLegs()->count());
    }
} 