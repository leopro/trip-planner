<?php

namespace Leopro\TripPlanner\InfrastructureBundle\Tests;

use Leopro\TripPlanner\Domain\Entity\Trip;
use Leopro\TripPlanner\Domain\ValueObject\TripIdentity;
use Leopro\TripPlanner\InfrastructureBundle\Repository\TripRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TripRepositoryTest extends WebTestCase
{
    public function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->repo = new TripRepository($this->em);
    }

    public function testGet()
    {
        $trip = $this->repo->get(new TripIdentity('abcd'));
        $this->assertInstanceOf('Leopro\TripPlanner\Domain\Entity\Trip', $trip);
    }

    public function testAdd()
    {
        $identity = uniqid();
        $tripIdentity = new TripIdentity($identity);
        $trip = Trip::createWithFirstRoute($tripIdentity, 'another trip');

        $this->repo->add($trip);

        $trip = $this->em->getRepository('TripPlannerDomain:Trip')->findOneBy(array('name' => 'another trip'));
        $this->assertInstanceOf('Leopro\TripPlanner\Domain\Entity\Trip', $trip);
    }

    public function tearDown()
    {
        $trip = $this->em->getRepository('TripPlannerDomain:Trip')->findOneBy(array('name' => 'another trip'));
        if ($trip) {
            $this->em->remove($trip);
        }
    }
} 