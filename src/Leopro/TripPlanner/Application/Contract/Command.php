<?php

namespace Leopro\TripPlanner\Application\Contract;

interface Command
{
    /**
     * @return \Leopro\TripPlanner\Domain\Contract\Collection
     */
    public function getRequest();
} 