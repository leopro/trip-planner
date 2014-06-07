<?php

namespace Leopro\TripPlanner\Domain\Entity;

use Leopro\TripPlanner\Domain\ValueObject\InternalIdentity;
use Leopro\TripPlanner\Domain\ValueObject\Point;

class Location
{
    private $internalIdentity;
    private $name;
    private $point;

    private function __construct(InternalIdentity $internalIdentity,
                                 $name,
                                 Point $point)
    {
        $this->internalIdentity = $internalIdentity;
        $this->name = $name;
        $this->point = $point;
    }

    public static function create($name, $latitude, $longitude)
    {
        return new self(
            new InternalIdentity,
            $name,
            new Point($latitude, $longitude)
        );
    }

    public function getPoint()
    {
        return $this->point;
    }
} 