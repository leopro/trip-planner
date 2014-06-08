<?php

namespace Leopro\TripPlanner\Application\Contract;

interface EventDispatcher
{
    /**
     * @param array $listeners
     * @return EventListener[]
     */
    public function registerListeners(array $listeners);

    /**
     * @param $event
     */
    public function notify($name, $event);
} 