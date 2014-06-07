<?php

namespace Leopro\TripPlanner\Domain\ValueObject;

class Point
{
    private $latitude;
    private $longitude;

    public function __construct($latitude, $longitude)
    {
        if (!$this->isValidLatitude($latitude)) {
            throw new \InvalidArgumentException('latitude is not valid');
        }

        if (!$this->isValidLongitude($longitude)) {
            throw new \InvalidArgumentException('longitude is not valid');
        }

        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function getApproximateRoadDistance(Point $point, $degreeApproximation = 10)
    {
        $distance = $this->getCartographicDistance($point);

        return round($distance + $distance * ($degreeApproximation / 100));
    }

    /**
     * @param Point $point
     * @return float
     *
     * thanks to http://stackoverflow.com/questions/7672759/how-to-calculate-distance-from-lat-long-in-php
     */
    public function getCartographicDistance(Point $point)
    {
        $earthRadius = 3958.75;

        $dLat = deg2rad($point->getLatitude() - $this->latitude);
        $dLng = deg2rad($point->getLongitude() - $this->longitude);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($this->latitude)) * cos(deg2rad($point->getLatitude())) *
            sin($dLng / 2) * sin($dLng / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $dist = $earthRadius * $c;

        // from miles to km
        $meterConversion = 1.609344;
        $geopointDistance = $dist * $meterConversion;

        return round($geopointDistance, 0);
    }

    private function isValidLatitude($latitude)
    {
        return preg_match("/^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,6}$/", $latitude);
    }

    private function isValidLongitude($longitude)
    {
        return preg_match("/^-?([1]?[1-7][1-9]|[1]?[1-8][0]|[1-9]?[0-9])\.{1}\d{1,6}$/", $longitude);
    }
} 