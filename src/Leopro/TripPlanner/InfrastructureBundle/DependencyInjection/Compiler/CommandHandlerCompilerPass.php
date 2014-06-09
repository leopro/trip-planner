<?php

namespace Leopro\TripPlanner\InfrastructureBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class CommandHandlerCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('command_handler')) {
            return;
        }

        $definition = $container->getDefinition('command_handler');
        $taggedServices = $container->findTaggedServiceIds('use_case');

        $useCases = array();

        foreach ($taggedServices as $id => $attributes) {
            $useCases[] = new Reference($id);
        }

        $definition->addMethodCall(
            'registerUseCases',
            array($useCases)
        );
    }
} 