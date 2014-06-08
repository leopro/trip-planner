<?php

namespace Leopro\TripPlanner\Application\Contract;

interface Validator
{
    /**
     * @param $value
     * @return \Leopro\TripPlanner\Domain\Contract\Collection
     */
    public function validate($value);
} 