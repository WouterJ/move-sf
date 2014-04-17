<?php

namespace Wj\MoveBundle;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Wj\Move\ComponentManager;
use Wj\Move\Exception\ComponentException;

/**
 * @author Wouter J <wouter@wouterj.nl>
 */
class ContainerAwareComponentManager extends ComponentManager
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function addComponent($alias, $id)
    {
        if (isset($this->components[$alias])) {
            throw ComponentException::alreadyExists($alias);
        }

        $this->components[$alias] = $id;
    }

    public function useComponent($name)
    {
        $name = $this->replaceAlias($name);
        if (!isset($this->components[$name]) || !$this->container->has($this->components[$name])) {
            throw ComponentException::doesNotExists($name);
        }

        $component = $this->container->get($this->components[$name]);
        $component->trigger('component.initialize');
        $this->initializedComponents[$name] = $component;
    }

    public function getComponent($name)
    {
        $name = $this->replaceAlias($name);
        if (!isset($this->initializedComponents[$name])) {
            if (!isset($this->components[$name]) || !$this->container->has($this->components[$name])) {
                throw ComponentException::doesNotExists($name);
            }

            throw ComponentException::isNotInitialized($name);
        }

        return $this->container->get($this->components[$name]);
    }
}
