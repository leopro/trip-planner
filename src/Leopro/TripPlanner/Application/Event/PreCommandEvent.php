<?php

namespace Leopro\TripPlanner\Application\Event;

use Leopro\TripPlanner\Application\Contract\Command;

class PreCommandEvent
{
    private $command;

    public function __construct(Command $command)
    {
        $this->command = $command;
    }

    public function getCommand()
    {
        return $this->command;
    }
} 