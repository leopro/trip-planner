<?php

namespace Leopro\TripPlanner\Application\Tests;

use Leopro\TripPlanner\Application\Command\CommandHandler;
use Leopro\TripPlanner\Application\Contract\Command;
use Leopro\TripPlanner\Domain\Adapter\ArrayCollection;

class CommandHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->useCase = $this->getMockBuilder('Leopro\TripPlanner\Application\Contract\UseCase')
            ->disableOriginalConstructor()
            ->getMock();

        $this->validator = $this->getMockBuilder('Leopro\TripPlanner\Application\Contract\Validator')
            ->disableOriginalConstructor()
            ->getMock();

        $this->commandHandler = new CommandHandler($this->validator);
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
            ->will($this->returnValue('Leopro\TripPlanner\Application\Tests\Fake'));

        $this->validator
            ->expects($this->once())
            ->method('validate')
            ->will($this->returnValue(new ArrayCollection()));

        $this->useCase
            ->expects($this->once())
            ->method('run');

        $this->commandHandler->registerCommands(array(
           $this->useCase
        ));

        $result = $this->commandHandler->execute(new Fake());
        $this->assertInstanceOf('Leopro\TripPlanner\Application\Response\Response', $result);
    }

    public function testCommandValidation()
    {
        $this->validator
            ->expects($this->once())
            ->method('validate')
            ->will($this->returnValue(new ArrayCollection(array('name' => 'This value should not be blank'))));

        $this->useCase
            ->expects($this->once())
            ->method('getManagedCommand')
            ->will($this->returnValue('Leopro\TripPlanner\Application\Tests\Fake'));

        $this->commandHandler->registerCommands(array(
           $this->useCase
        ));

        $response = $this->commandHandler->execute(new Fake());
        $errors = $response->getContent();
        $this->assertEquals('This value should not be blank', $errors->get('name'));
    }
}

class Fake implements Command
{
    public function getRequest()
    {

    }
}