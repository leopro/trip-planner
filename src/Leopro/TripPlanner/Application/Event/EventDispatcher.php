<?php

namespace Leopro\TripPlanner\Application\Event;

use Leopro\TripPlanner\Application\Contract\EventDispatcher as EventDispatcherInterface;
use Leopro\TripPlanner\Application\Contract\EventListener;

class EventDispatcher implements EventDispatcherInterface
{
    private $listeners;

    /**
     * @param array $listeners
     * @return EventListener[]
     */
    public function registerListeners(array $listeners)
    {
        foreach ($listeners as $listener) {
            if ($listener instanceof EventListener) {
                $this->listeners[] = $listener;
            } else {
                throw new \LogicException('EventDispatcher registerListeners expects an array of EventListener');
            }
        }
    }

    /**
     * @param $event
     */
    public function notify($name, $event)
    {
        foreach ($this->listeners as $listener) {
            $subscribedEvents = $listener->getSubscribedEvents();
            if (is_array($subscribedEvents) && count($subscribedEvents) > 0 && array_key_exists($name, $subscribedEvents)) {
                $method = $subscribedEvents[$name];
                call_user_func_array(array($listener, $method), array($event));
            }
        }
    }
} 