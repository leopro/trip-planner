<?php

namespace Leopro\TripPlanner\Application\Command;

use Leopro\TripPlanner\Application\Contract\UseCase;
use Leopro\TripPlanner\Application\Contract\Validator;
use Leopro\TripPlanner\Application\Exception\ValidationException;
use Leopro\TripPlanner\Application\Response\Response;
use Leopro\TripPlanner\Domain\Exception\DomainException;

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

        try {

            $errors = $this->validator->validate($command);
            if ($errors->count() > 0) {
                throw new ValidationException($errors);
            }

            $result = $this->useCases[get_class($command)]->run($command);

            return new Response($result);

        } catch (DomainException $e) {
            return new Response($e->getMessage());
        } catch (ValidationException $e) {
            return new Response($errors);
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