<?php

namespace Leopro\TripPlanner\Application\Contract;

interface UseCase
{
    /**
     * @return string
     */
    public function getManagedCommand();

    /**
     * @param Command $command
     * @return mixed
     */
    public function run(Command $command);
} 