<?php

namespace Leopro\TripPlanner\Domain\Entity;

use Leopro\TripPlanner\Domain\ValueObject\Date;
use Leopro\TripPlanner\Domain\ValueObject\InternalIdentity;

class Leg
{
    private $internalIdentity;
    private $date;
    private $location;

    private function __construct(InternalIdentity $internalIdentity,
                                 Date $date,
                                 Location $location)
    {
        $this->internalIdentity = $internalIdentity;
        $this->date = $date;
        $this->location = $location;
    }

    public static function create($date, $dateFormat, $latitude, $longitude)
    {
        $date = new Date($date, $dateFormat);
        return new self(
            new InternalIdentity,
            $date,
            Location::create($date->getFormattedDate(), $latitude, $longitude)
        );
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getLocation()
    {
        return $this->location;
    }
} 