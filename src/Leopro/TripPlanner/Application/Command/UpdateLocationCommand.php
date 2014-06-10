<?php

namespace Leopro\TripPlanner\Application\Command;

use Leopro\TripPlanner\Application\Contract\Command;
use Leopro\TripPlanner\Domain\Adapter\ArrayCollection;

class UpdateLocationCommand implements Command
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

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getRouteIdentity()
    {
        return $this->routeIdentity;
    }
} 