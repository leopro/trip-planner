<?php

namespace Leopro\TripPlanner\Application\Contract;

interface EventListener
{
    /**
     * @return array An associative array event_name => method_to_call
     */
    public function getSubscribedEvents();
}