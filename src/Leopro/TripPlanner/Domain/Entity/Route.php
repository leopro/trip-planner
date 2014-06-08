<?php

namespace Leopro\TripPlanner\Domain\Entity;

use Leopro\TripPlanner\Domain\Adapter\ArrayCollection;
use Leopro\TripPlanner\Domain\Exception\DateAlreadyUsedException;
use Leopro\TripPlanner\Domain\Exception\ResourceNotFoundException;
use Leopro\TripPlanner\Domain\ValueObject\InternalIdentity;

class Route
{
    private $internalIdentity;
    private $name;

    /**
     * @var \Leopro\TripPlanner\Domain\Entity\Leg[]
     */
    private $legs;

    private function __construct(InternalIdentity $internalIdentity,
                                 $name)
    {
        $this->internalIdentity = $internalIdentity;
        $this->name = $name;
        $this->legs = new ArrayCollection();
    }

    public static function create($tripName)
    {
        return new self(
            new InternalIdentity,
            'first route for trip: ' . $tripName
        );
    }

    public function addLeg($date, $latitude, $longitude, $dateFormat = 'd-m-Y')
    {
        $leg = Leg::create($date, $dateFormat, $latitude, $longitude);

        $dateAlreadyUsed = function($key, $element) use($leg) {
            return $element->getDate() == $leg->getDate();
        };

        if ($this->legs->exists($dateAlreadyUsed)) {
            throw new DateAlreadyUsedException($date . ' already used');
        }

        $this->legs->add($leg);
    }

    public function getApproximateRoadDistance()
    {
        $distance = 0;
        $iterator = $this->legs->getIterator();

        while($iterator->valid()) {

            $pointFrom = $iterator->current()->getLocation()->getPoint();

            $iterator->next();
            if (!$iterator->valid()) {
                break;
            }

            $pointTo = $iterator->current()->getLocation()->getPoint();

            $distance += $pointFrom->getApproximateRoadDistance($pointTo);
        }

        return $distance;
    }

    public function duplicate()
    {
        return clone $this;
    }

    public function getLegByDate($date)
    {
        foreach ($this->legs as $leg) {
            $legDate = $leg->getDate()->getFormattedDate();
            if ($legDate == $date) {
                return $leg;
            }
        }

        throw new ResourceNotFoundException(sprintf('Leg with date \'%s\' not found', $date));
    }

    public function getLegs()
    {
        return $this->legs;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getInternalIdentity()
    {
        return $this->internalIdentity;
    }
} 