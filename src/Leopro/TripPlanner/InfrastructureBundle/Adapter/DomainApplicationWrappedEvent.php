<?php

namespace Leopro\TripPlanner\InfrastructureBundle\Adapter;

use Symfony\Component\EventDispatcher\Event;

class DomainApplicationWrappedEvent extends Event
{
    private $domainApplicationEvent;

    public function __construct($domainApplicationEvent)
    {
        $this->domainApplicationEvent = $domainApplicationEvent;
    }

    public function getDomainApplicationEvent()
    {
        return $this->domainApplicationEvent;
    }
} 