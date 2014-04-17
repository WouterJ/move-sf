<?php

namespace Wj\Move;

use Wj\Move\Exception\ComponentException;

/**
 * @author Wouter J <wouter@wouterj.nl>
 */
class ComponentManager
{
    protected $components = array();
    protected $replaces = array();
    protected $initializedComponents = array();

    public function __construct(array $components = array())
    {
        $this->components = $components;
    }

    public function replaceComponent($fromAlias, $toAlias)
    {
        $this->replaces[$fromAlias] = $toAlias;
    }

    public function addComponent($alias, $component)
    {
        if (isset($this->components[$alias])) {
            throw ComponentException::alreadyExists($alias);
        }

        $this->components[$alias] = $component;
    }

    public function useComponent($name)
    {
        $name = $this->replaceAlias($name);
        if (!isset($this->components[$name])) {
            throw ComponentException::doesNotExists($name);
        }

        $component = $this->components[$name];
        $component->trigger('component.initialize');
        $this->initializedComponents[$name] = $component;
    }

    /**
     * @param string $name
     *
     * @return Component
     *
     * @throws Exception\ComponentException
     */
    public function getComponent($name)
    {
        $name = $this->replaceAlias($name);
        if (!isset($this->initializedComponents[$name])) {
            if (!isset($this->components[$name])) {
                throw ComponentException::doesNotExists($name);
            }

            throw ComponentException::isNotInitialized($name);
        }

        return $this->components[$name];
    }

    protected function replaceAlias($alias)
    {
        return isset($this->replaces[$alias]) ? $this->replaces[$alias] : $alias;
    }
}
