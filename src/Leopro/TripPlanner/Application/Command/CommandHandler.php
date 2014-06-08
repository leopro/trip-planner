<?php

namespace Leopro\TripPlanner\Application\Command;

use Leopro\TripPlanner\Application\Contract\EventDispatcher;
use Leopro\TripPlanner\Application\Contract\UseCase;
use Leopro\TripPlanner\Application\Contract\Validator;
use Leopro\TripPlanner\Application\Event\ExceptionEvent;
use Leopro\TripPlanner\Application\Event\PostCommandEvent;
use Leopro\TripPlanner\Application\Event\PreCommandEvent;
use Leopro\TripPlanner\Application\Exception\ValidationException;
use Leopro\TripPlanner\Application\Response\Response;
use Leopro\TripPlanner\Domain\Exception\DomainException;
use Leopro\TripPlanner\Application\Event\Events;

class CommandHandler
{
    private $validator;
    private $eventDispatcher;

    public function __construct(Validator $validator,
                                EventDispatcher $eventDispatcher)
    {
        $this->validator = $validator;
        $this->eventDispatcher = $eventDispatcher;
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

            $this->eventDispatcher->notify(Events::PRE_COMMAND, new PreCommandEvent($command));

            $errors = $this->validator->validate($command);
            if ($errors->count() > 0) {
                throw new ValidationException($errors);
            }

            $result = $this->useCases[get_class($command)]->run($command);
            $response = new Response($result);

            $this->eventDispatcher->notify(Events::POST_COMMAND, new PostCommandEvent($command, $response));

            return $response;

        } catch (DomainException $e) {
            $this->eventDispatcher->notify(Events::EXCEPTION, new ExceptionEvent($command, $e));
            return new Response($e->getMessage());
        } catch (ValidationException $e) {
            $this->eventDispatcher->notify(Events::EXCEPTION, new ExceptionEvent($command, $e));
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