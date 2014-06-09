<?php

namespace Leopro\TripPlanner\Domain\Entity;

use Leopro\TripPlanner\Domain\ValueObject\Point;

class Location
{
    private $internalIdentity;
    private $name;
    private $point;

    private function __construct($name,
                                 Point $point)
    {
        $this->name = $name;
        $this->point = $point;
    }

    public static function create($name, $latitude, $longitude)
    {
        return new self(
            $name,
            new Point($latitude, $longitude)
        );
    }

    public function updateName($name)
    {
        $this->name = $name;
    }

    public function getPoint()
    {
        return $this->point;
    }

    public function getName()
    {
        return $this->name;
    }
} 