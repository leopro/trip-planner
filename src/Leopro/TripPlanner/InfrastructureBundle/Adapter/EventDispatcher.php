<?php

namespace Leopro\TripPlanner\InfrastructureBundle\Adapter;

use Leopro\TripPlanner\Application\Contract\EventListener;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Leopro\TripPlanner\Application\Event\Events;

class EventDispatcher implements EventListener
{
    private $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function getSubscribedEvents()
    {
        return array(
            Events::PRE_COMMAND => 'onDomainApplicationEvent',
            Events::POST_COMMAND => 'onDomainApplicationEvent',
            Events::EXCEPTION => 'onDomainApplicationEvent'
        );
    }

    public function onDomainApplicationEvent($event)
    {
        $wrapped = new DomainApplicationWrappedEvent($event);

        $this->eventDispatcher->dispatch('domain-application-event', $wrapped);
    }
} 