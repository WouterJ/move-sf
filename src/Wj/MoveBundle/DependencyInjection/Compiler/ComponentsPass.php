<?php

namespace Wj\MoveBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Wouter J <wouter@wouterj.nl>
 */
class ComponentsPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('wj_move.component_manager')) {
            return;
        }

        $manager = $container->getDefinition('wj_move.component_manager');

        foreach ($container->findTaggedServiceIds('wj_move.component') as $id => $tags) {
            foreach ($tags as $attributes) {
                $manager->addMethodCall('addComponent', array(
                    $attributes['alias'],
                    $id,
                ));
            }
        }
    }
}