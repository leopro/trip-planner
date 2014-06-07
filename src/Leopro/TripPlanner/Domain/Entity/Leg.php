<?php

namespace Leopro\TripPlanner\Domain\Entity;

use Leopro\TripPlanner\Domain\ValueObject\Date;
use Leopro\TripPlanner\Domain\ValueObject\InternalIdentity;

class Leg
{
    private $internalIdentity;
    private $date;

    private function __construct(InternalIdentity $internalIdentity,
                                 Date $date)
    {
        $this->internalIdentity = $internalIdentity;
        $this->date = $date;
    }

    public static function create($date)
    {
        $date = new Date($date, 'd-m-Y');
        return new self(
            new InternalIdentity,
            $date
        );
    }

    public function getDate()
    {
        return $this->date;
    }
} 