<?php

namespace Leopro\TripPlanner\Application\Command;

use Leopro\TripPlanner\Application\Contract\Command;
use Leopro\TripPlanner\Domain\Adapter\ArrayCollection;

class CreateTripCommand implements Command
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getRequest()
    {
        return new ArrayCollection(
            array(
                'name' => $this->name
            )
        );
    }
} 