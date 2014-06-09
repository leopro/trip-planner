<?php

namespace Leopro\TripPlanner\InfrastructureBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Leopro\TripPlanner\Domain\Entity\Trip;
use Leopro\TripPlanner\Domain\ValueObject\TripIdentity;

class CompleteTripData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $tripIdentity = new TripIdentity('abcd');
        $trip = Trip::createWithFirstRoute($tripIdentity, 'my complete trip');

        $route = $trip->getRoutes()->first();
        $route->addLeg('01/01/2014', -3.386665, 36.736908, 'd/m/Y');

        $manager->persist($trip);

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
} 