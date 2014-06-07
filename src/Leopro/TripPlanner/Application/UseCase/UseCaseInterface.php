<?php

namespace Leopro\TripPlanner\Application\UseCase;

use Leopro\TripPlanner\Application\Command\CommandInterface;

interface UseCaseInterface
{
    function getManagedCommand();

    function run(CommandInterface $command);
} 