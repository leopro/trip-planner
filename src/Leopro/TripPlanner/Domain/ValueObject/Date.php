<?php

namespace Leopro\TripPlanner\Domain\ValueObject;

class Date
{
    private $input;
    private $format;

    public function __construct($input, $format = 'Y-m-d')
    {
        $this->input = \DateTime::createFromFormat($format, $input);
        $this->format = $format;
    }

    public function getFormattedDate($format = null)
    {
        if (!$format) {
            $format = $this->format;
        }

        return $this->input->format($format);
    }
} 