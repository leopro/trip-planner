<?php

namespace Leopro\TripPlanner\InfrastructureBundle;

use Leopro\TripPlanner\InfrastructureBundle\DependencyInjection\Compiler\CommandHandlerCompilerPass;
use Leopro\TripPlanner\InfrastructureBundle\DependencyInjection\Compiler\EventDispatcherCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class InfrastructureBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new CommandHandlerCompilerPass());
        $container->addCompilerPass(new EventDispatcherCompilerPass());
    }
} 