<?php

namespace Leopro\TripPlanner\Domain\Entity;

use Leopro\TripPlanner\Domain\ValueObject\Date;

class Leg
{
    private $internalIdentity;
    private $date;
    private $location;

    private function __construct(Date $date,
                                 Location $location)
    {
        $this->date = $date;
        $this->location = $location;
    }

    public static function create($date, $dateFormat, $latitude, $longitude)
    {
        $date = new Date($date, $dateFormat);
        return new self(
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