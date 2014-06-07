<?php

namespace Leopro\TripPlanner\Application\Command;

use Leopro\TripPlanner\Application\Contract\CommandInterface;
use Leopro\TripPlanner\Domain\Adapter\ArrayCollection;

class CreateTripCommand implements CommandInterface
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