<?php

namespace Leopro\TripPlanner\Application\Tests;

use Leopro\TripPlanner\Application\Command\CreateTripCommand;
use Leopro\TripPlanner\Application\UseCase\CreateTripUseCase;

class CreateTripTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateTrip()
    {
        $tripRepository = $this->getMockBuilder('Leopro\TripPlanner\Domain\Contract\TripRepository')
            ->disableOriginalConstructor()
            ->getMock();

        $tripRepository
            ->expects($this->once())
            ->method('add');

        $command = new CreateTripCommand('my trip');
        $useCase = new CreateTripUseCase($tripRepository);

        $trip = $useCase->run($command);

        $this->assertInstanceOf('Leopro\TripPlanner\Domain\Entity\Trip', $trip);
    }
} 