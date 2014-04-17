<?php

namespace Wj\MoveBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class WjMoveExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        if (isset($config['replace_components'])) {
            $this->configureReplacedComponents($config['replace_components'], $container->getDefinition('wj_move.component_manager'));
        }
    }

    private function configureReplacedComponents($config, Definition $managerDefinition)
    {
        foreach ($config as $replaces) {
            $managerDefinition->addMethodCall('replaceComponent', array($replaces['from'], $replaces['to']));
        }
    }
}
