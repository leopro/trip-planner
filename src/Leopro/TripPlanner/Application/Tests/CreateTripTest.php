<?php

namespace Leopro\TripPlanner\Application\Tests;

use Leopro\TripPlanner\Application\Command\CreateTripCommand;
use Leopro\TripPlanner\Application\UseCase\CreateTripUseCase;

class CreateTripTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateTrip()
    {
        $command = new CreateTripCommand('my trip');
        $useCase = new CreateTripUseCase();

        $trip = $useCase->run($command);

        $this->assertInstanceOf('Leopro\TripPlanner\Domain\Entity\Trip', $trip);
    }
} 