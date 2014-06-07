<?php

namespace Leopro\TripPlanner\Application\Command;

use Leopro\TripPlanner\Application\Contract\CommandInterface;
use Leopro\TripPlanner\Domain\Adapter\ArrayCollection;

class UpdateLocationCommand implements CommandInterface
{
    private $routeIdentity;
    private $date;
    private $name;

    public function __construct($routeIdentity,
                                $date,
                                $name)
    {
        $this->routeIdentity = $routeIdentity;
        $this->date = $date;
        $this->name = $name;
    }

    public function getRequest()
    {
        return new ArrayCollection(
            array(
                'routeIdentity' => $this->routeIdentity,
                'date' => $this->date,
                'name' => $this->name
            )
        );
    }
} 