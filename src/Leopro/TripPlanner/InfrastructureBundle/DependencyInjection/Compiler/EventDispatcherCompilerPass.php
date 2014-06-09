<?php

namespace Leopro\TripPlanner\InfrastructureBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class EventDispatcherCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('application.event_dispatcher')) {
            return;
        }

        $definition = $container->getDefinition('application.event_dispatcher');
        $taggedServices = $container->findTaggedServiceIds('event_dispatcher_listener');

        $listeners = array();

        foreach ($taggedServices as $id => $attributes) {
            $listeners[] = new Reference($id);
        }

        $definition->addMethodCall(
            'registerListeners',
            array($listeners)
        );
    }
} 