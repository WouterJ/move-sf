<?php

namespace Wj\MoveBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $root = $treeBuilder->root('wj_move');

        $root
            ->fixXmlConfig('replace_component')
            ->children()
                ->arrayNode('replace_components')
                    ->beforeNormalization()
                        ->ifTrue(function ($v) {
                            if (0 === count($v)) {
                                return false;
                            }

                            return !is_array(current($v));
                        })
                        ->then(function ($v) {
                            foreach ($v as $from => $to) {
                                if (is_array($to)) {
                                    continue;
                                }

                                $v[] = array('from' => $from, 'to' => $to);
                                unset($v[$from]);
                            }

                            return $v;
                        })
                    ->end()
                    ->prototype('array')
                        ->children()
                            ->scalarNode('from')->isRequired()->end()
                            ->scalarNode('to')->isRequired()->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
