<?php

namespace Leopro\TripPlanner\Application\Contract;

interface CommandInterface
{
    /**
     * @return \Leopro\TripPlanner\Domain\Contract\Collection
     */
    public function getRequest();
} 