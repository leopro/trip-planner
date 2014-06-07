<?php

namespace Leopro\TripPlanner\Domain\Tests;

use Leopro\TripPlanner\Application\Command\CommandHandler;
use Leopro\TripPlanner\Application\Command\CommandInterface;

class CommandHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->useCase = $this->getMockBuilder('Leopro\TripPlanner\Application\UseCase\UseCaseInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $this->commandHandler = new CommandHandler();
    }

    public function testRegisterCommandsWithCorrectInterface()
    {
        $this->commandHandler->registerCommands(array(
           $this->useCase,
           $this->useCase
        ));
    }

    /**
     * @expectedException \LogicException
     */
    public function testRegisterCommandsExceptionIfUseCaseDoesNotRespectInterface()
    {
        $this->commandHandler->registerCommands(array(
           new \stdClass()
        ));
    }

    public function testExecute()
    {
        $this->useCase
            ->expects($this->once())
            ->method('getManagedCommand')
            ->will($this->returnValue('Leopro\TripPlanner\Domain\Tests\Fake'));

        $this->useCase
            ->expects($this->once())
            ->method('run');

        $this->commandHandler->registerCommands(array(
           $this->useCase
        ));

        $this->commandHandler->execute(new Fake());
    }
}

class Fake implements CommandInterface
{
    public function getRequest()
    {

    }
}