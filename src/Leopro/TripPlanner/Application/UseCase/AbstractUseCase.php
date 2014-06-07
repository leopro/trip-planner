<?php

namespace Leopro\TripPlanner\Application\UseCase;

abstract class AbstractUseCase
{
    protected function exceptionIfCommandNotManaged($command)
    {
        $commandClass = get_class($command);
        if ($commandClass != $this->getManagedCommand()) {
            throw new \LogicException($commandClass . ' is not a managed command');
        }
    }
} 