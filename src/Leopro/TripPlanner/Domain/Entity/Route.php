<?php

namespace Leopro\TripPlanner\Domain\Entity;

use Leopro\TripPlanner\Domain\ValueObject\InternalIdentity;
use Leopro\TripPlanner\Domain\ValueObject\TripIdentity;

class Route
{
    private $tripIdentity;
    private $internalIdentity;
    private $name;

    private function __construct(TripIdentity $tripIdentity,
                                 InternalIdentity $internalIdentity,
                                 $name)
    {
        $this->tripIdentity = $tripIdentity;
        $this->internalIdentity = $internalIdentity;
        $this->name = $name;
    }

    public static function createFirst(Trip $trip)
    {
        return new self($trip->getIdentity(), new InternalIdentity, 'first route for trip: ' . $trip->getName());
    }

    public function getName()
    {
        return $this->name;
    }

    public function getTripIdentity()
    {
        return $this->tripIdentity;
    }
} 