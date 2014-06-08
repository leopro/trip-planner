<?php

namespace Leopro\TripPlanner\Application\Command;

use Leopro\TripPlanner\Application\Contract\Command;
use Leopro\TripPlanner\Domain\Adapter\ArrayCollection;

class AddLegToRouteCommand implements Command
{
    private $tripIdentity;
    private $routeIdentity;
    private $date;
    private $dateFormat;
    private $latitude;
    private $longitude;

    public function __construct($tripIdentity,
                                $routeIdentity,
                                $date,
                                $dateFormat,
                                $latitude,
                                $longitude)
    {
        $this->tripIdentity = $tripIdentity;
        $this->routeIdentity = $routeIdentity;
        $this->date = $date;
        $this->dateFormat = $dateFormat;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getRequest()
    {
        return new ArrayCollection(
            array(
                'tripIdentity' => $this->tripIdentity,
                'routeIdentity' => $this->routeIdentity,
                'date' => $this->date,
                'dateFormat' => $this->dateFormat,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude
            )
        );
    }
} 