<?php

namespace Leopro\TripPlanner\Domain\ValueObject;

class Date
{
    private $input;
    private $format;

    public function __construct($input, $format = 'Y-m-d')
    {
        $this->input = $input;
        $this->format = $format;
    }

    public function getFormattedDate($format = 'Y-m-d')
    {
        $date = \DateTime::createFromFormat($this->format, $this->input);
        $formattedDate = $date->format($format);

        return $formattedDate;
    }
} 