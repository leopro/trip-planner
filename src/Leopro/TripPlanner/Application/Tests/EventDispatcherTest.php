<?php

namespace Leopro\TripPlanner\Application\Tests;

use Leopro\TripPlanner\Application\Event\EventDispatcher;

class EventDispatcherTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->listener1 = $this->getMockBuilder('Leopro\TripPlanner\Application\Contract\EventListener')
            ->setMethods(array('onMyEvent', 'getSubscribedEvents'))
            ->disableOriginalConstructor()
            ->getMock();

        $this->listener2 = $this->getMockBuilder('Leopro\TripPlanner\Application\Contract\EventListener')
            ->setMethods(array('onMyEvent', 'getSubscribedEvents'))
            ->disableOriginalConstructor()
            ->getMock();

        $this->listener3 = $this->getMockBuilder('Leopro\TripPlanner\Application\Contract\EventListener')
            ->setMethods(array('onMyEvent', 'getSubscribedEvents'))
            ->disableOriginalConstructor()
            ->getMock();

        $this->eventDispatcher = new EventDispatcher();
    }

    /**
     * @expectedException \LogicException
     */
    public function testRegisterListenersExceptionIfListenerDoesNotRespectInterface()
    {
        $this->eventDispatcher->registerListeners(array(
           new \stdClass()
        ));
    }

    public function testRegisterListenersWithCorrectInterface()
    {
        $this->eventDispatcher->registerListeners(array(
           $this->listener1,
           $this->listener2
        ));
    }

    public function testNotify()
    {
        $subscribedEvents = array(
            'my_event' => 'onMyEvent'
        );

        $event = new Event;

        $this->eventDispatcher->registerListeners(array(
           $this->listener1,
           $this->listener2,
           $this->listener3
        ));

        $this->listener1
            ->expects($this->once())
            ->method('getSubscribedEvents')
            ->will($this->returnValue($subscribedEvents));

        $this->listener2
            ->expects($this->once())
            ->method('getSubscribedEvents')
            ->will($this->returnValue($subscribedEvents));

        $this->listener3
            ->expects($this->once())
            ->method('getSubscribedEvents')
            ->will($this->returnValue(array()));

        $this->listener1->expects($this->once())
            ->method('onMyEvent')
            ->with($event);

        $this->listener2->expects($this->once())
            ->method('onMyEvent')
            ->with($event);

        $this->eventDispatcher->notify('my_event', $event);
    }
}

class Event
{

}