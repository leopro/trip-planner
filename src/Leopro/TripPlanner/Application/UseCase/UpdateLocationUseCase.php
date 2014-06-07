<?php

namespace Leopro\TripPlanner\Application\UseCase;

use Leopro\TripPlanner\Application\Contract\CommandInterface;
use Leopro\TripPlanner\Application\Contract\UseCaseInterface;
use Leopro\TripPlanner\Domain\Contract\TripRepository;
use Leopro\TripPlanner\Domain\Entity\Trip;
use Leopro\TripPlanner\Domain\ValueObject\Date;
use Leopro\TripPlanner\Domain\ValueObject\TripIdentity;

class UpdateLocationUseCase extends AbstractUseCase implements UseCaseInterface
{
    private $tripRepository;

    public function __construct(TripRepository $tripRepository)
    {
        $this->tripRepository = $tripRepository;
    }

    public function getManagedCommand()
    {
        return 'Leopro\TripPlanner\Application\Command\UpdateLocationCommand';
    }

    public function run(CommandInterface $command)
    {
        $this->exceptionIfCommandNotManaged($command);

        $request = $command->getRequest();

        $trip = $this->tripRepository->get(
            new TripIdentity($request->get('tripIdentity'))
        );

        if (!$trip) {
            throw new ResourceNotFoundException(
                sprintf('Trip with identity \'%s\' not found', $request->get('tripIdentity'))
            );
        }

        $route = $trip->getRoute($request->get('routeIdentity'));
        $leg = $route->getLegByDate($request->get('date'));
        $leg->getLocation()->updateName($request->get('name'));

        $this->tripRepository->add($trip);

        return $trip;
    }
} 