<?php

namespace Leopro\TripPlanner\Application\Contract;

interface UseCaseInterface
{
    public function getManagedCommand();

    public function run(CommandInterface $command);
} 