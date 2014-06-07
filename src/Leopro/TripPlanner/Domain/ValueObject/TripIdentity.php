<?php

namespace Leopro\TripPlanner\Domain\ValueObject;

class TripIdentity
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
} 