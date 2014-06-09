<?php

namespace Leopro\TripPlanner\InfrastructureBundle\Tests;

use Leopro\TripPlanner\Application\Command\AddLegToRouteCommand;
use Leopro\TripPlanner\Application\Command\CreateTripCommand;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreateCompleteTripIntegrationTest extends WebTestCase
{
    public function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();

        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->commandHandler = static::$kernel->getContainer()
            ->get('command_handler');
    }

    public function testCreateTripWithRouteAndLegs()
    {
        $createTrip = new CreateTripCommand('my new trip');
        $response = $this->commandHandler->execute($createTrip);

        $trip = $response->getContent();
        $tripIdentity = $trip->getIdentity()->getId();

        $route = $trip->getRoutes()->first();
        $this->assertEquals(0, $route->getLegs()->count());
        $routeIdentity = $route->getInternalIdentity();

        $addLeg = new AddLegToRouteCommand(
            $tripIdentity,
            $routeIdentity,
            '01/01/2014',
            'd/m/Y',
            -3.386665,
            36.736908)
        ;

        $this->commandHandler->execute($addLeg);
        $this->assertEquals(1, $route->getLegs()->count());
    }

    public function testCommandValidation()
    {
        $createTrip = new CreateTripCommand(null);
        $response = $this->commandHandler->execute($createTrip);

        $errorField = $response->getContent()->key();
        $errorMessage = $response->getContent()->current();

        $this->assertContains('name', $errorField);
        $this->assertContains('This value should not be blank', $errorMessage);
    }

    public function tearDown()
    {
        $trip = $this->em->getRepository('TripPlannerDomain:Trip')->findOneBy(array('name' => 'my new trip'));
        if ($trip) {
            $this->em->remove($trip);
        }
    }
} 