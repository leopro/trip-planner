<?php

namespace Leopro\TripPlanner\Application\UseCase;

use Leopro\TripPlanner\Application\Contract\Command;
use Leopro\TripPlanner\Application\Contract\UseCase;
use Leopro\TripPlanner\Domain\Contract\TripRepository;
use Leopro\TripPlanner\Domain\Exception\ResourceNotFoundException;
use Leopro\TripPlanner\Domain\ValueObject\TripIdentity;

class AddLegToRouteUseCase extends AbstractUseCase implements UseCase
{
    private $tripRepository;

    public function __construct(TripRepository $tripRepository)
    {
        $this->tripRepository = $tripRepository;
    }

    public function getManagedCommand()
    {
        return 'Leopro\TripPlanner\Application\Command\AddLegToRouteCommand';
    }

    public function run(Command $command)
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
        $route->addLeg(
            $request->get('date'),
            $request->get('latitude'),
            $request->get('longitude'),
            $request->get('dateFormat')
        );

        $this->tripRepository->add($trip);

        return $trip;
    }
} 