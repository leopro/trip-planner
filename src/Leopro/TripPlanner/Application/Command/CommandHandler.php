<?php

namespace Leopro\TripPlanner\Application\Command;

use Leopro\TripPlanner\Application\UseCase\UseCaseInterface;

class CommandHandler
{
    /**
     * @var UseCaseInterface[]
     */
    private $useCases;

    public function registerCommands(array $useCases)
    {
        foreach ($useCases as $useCase) {
            if ($useCase instanceof UseCaseInterface) {
                $this->useCases[$useCase->getManagedCommand()] = $useCase;
            } else {
                throw new \LogicException('CommandHandler registerCommands expects an array of UseCaseInterface');
            }
        }
    }

    public function execute($command)
    {
        try {

            $commandClass = get_class($command);
            if (!array_key_exists($commandClass, $this->useCases)) {
                throw new \LogicException($commandClass . ' is not a managed command');
            }

            $this->useCases[get_class($command)]->run($command);
        } catch (\Exception $e) {
            throw $e;
        }
    }
} 