<?php

namespace Leopro\TripPlanner\Domain\Contract;

use Leopro\TripPlanner\Domain\Entity\Trip;
use Leopro\TripPlanner\Domain\ValueObject\TripIdentity;

interface TripRepository
{
    /**
     * @param TripIdentity $identity
     * @return \Leopro\TripPlanner\Domain\Entity\Trip
     */
    public function get(TripIdentity $identity);

    /**
     * @param Trip $trip
     * @return void
     */
    public function add(Trip $trip);
} 