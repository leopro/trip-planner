<?php

namespace Leopro\TripPlanner\Application\Contract;

interface UseCaseInterface
{
    /**
     * @return string
     */
    public function getManagedCommand();

    /**
     * @param CommandInterface $command
     * @return mixed
     */
    public function run(CommandInterface $command);
} 