<?php

namespace Leopro\TripPlanner\Application\Command;

use Leopro\TripPlanner\Application\Contract\UseCase;
use Leopro\TripPlanner\Application\Contract\Validator;
use Leopro\TripPlanner\Application\Exception\ValidationException;

class CommandHandler
{
    private $validator;

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @var UseCase[]
     */
    private $useCases;

    public function registerCommands(array $useCases)
    {
        foreach ($useCases as $useCase) {
            if ($useCase instanceof UseCase) {
                $this->useCases[$useCase->getManagedCommand()] = $useCase;
            } else {
                throw new \LogicException('CommandHandler registerCommands expects an array of UseCase');
            }
        }
    }

    public function execute($command)
    {
        $this->exceptionIfCommandNotManaged($command);

        $errors = $this->validator->validate($command);
        if ($errors->count() > 0) {
            throw new ValidationException($errors);
        }

        try {
            $this->useCases[get_class($command)]->run($command);
        } catch (\DomainException $e) {
            throw $e;
        }
    }

    private function exceptionIfCommandNotManaged($command)
    {
        $commandClass = get_class($command);
        if (!array_key_exists($commandClass, $this->useCases)) {
            throw new \LogicException($commandClass . ' is not a managed command');
        }
    }
} 