<?php

namespace Leopro\TripPlanner\Application\UseCase;

use Leopro\TripPlanner\Application\Contract\CommandInterface;
use Leopro\TripPlanner\Application\Contract\UseCaseInterface;
use Leopro\TripPlanner\Domain\Entity\Trip;
use Leopro\TripPlanner\Domain\ValueObject\TripIdentity;

class CreateTripUseCase extends AbstractUseCase implements UseCaseInterface
{
    public function getManagedCommand()
    {
        return 'Leopro\TripPlanner\Application\Command\CreateTripCommand';
    }

    public function run(CommandInterface $command)
    {
        $this->exceptionIfCommandNotManaged($command);

        $request = $command->getRequest();
        $tripIdentity = new TripIdentity(uniqid());

        return Trip::create($tripIdentity, $request->get('name'));
    }
} 