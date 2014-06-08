<?php

namespace Leopro\TripPlanner\Application\Event;

use Leopro\TripPlanner\Application\Contract\Command;
use Leopro\TripPlanner\Application\Response\Response;

class PostCommandEvent
{
    private $command;
    private $response;

    public function __construct(Command $command, Response $response)
    {
        $this->command = $command;
    }

    public function getCommand()
    {
        return $this->command;
    }

    public function getResponse()
    {
        return $this->response;
    }
} 