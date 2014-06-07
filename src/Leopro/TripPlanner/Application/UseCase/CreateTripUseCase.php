<?php

namespace Leopro\TripPlanner\Application\UseCase;

use Leopro\TripPlanner\Application\Contract\CommandInterface;
use Leopro\TripPlanner\Application\Contract\UseCaseInterface;
use Leopro\TripPlanner\Domain\Contract\TripRepository;
use Leopro\TripPlanner\Domain\Entity\Trip;
use Leopro\TripPlanner\Domain\ValueObject\TripIdentity;

class CreateTripUseCase extends AbstractUseCase implements UseCaseInterface
{
    private $tripRepository;

    public function __construct(TripRepository $tripRepository)
    {
        $this->tripRepository = $tripRepository;
    }

    public function getManagedCommand()
    {
        return 'Leopro\TripPlanner\Application\Command\CreateTripCommand';
    }

    public function run(CommandInterface $command)
    {
        $this->exceptionIfCommandNotManaged($command);

        $request = $command->getRequest();

        $trip = Trip::createWithFirstRoute(
            new TripIdentity(uniqid()),
            $request->get('name')
        );

        $this->tripRepository->add($trip);

        return $trip;
    }
} 