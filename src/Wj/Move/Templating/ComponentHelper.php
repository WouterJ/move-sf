<?php

namespace Wj\Move\Templating;

use Symfony\Component\Templating\Helper\Helper;
use Wj\Move\ComponentManager;
use Wj\Move\Event;

/**
 * @author Wouter J <wouter@wouterj.nl>
 */
class ComponentHelper extends Helper
{
    /**
     * @var ComponentManager
     */
    private $manager;

    public function __construct(ComponentManager $manager)
    {
        $this->manager = $manager;
    }

    public function render($name, array $parameters = array())
    {
        $component = $this->manager->getComponent($name);

        return $component->trigger('component.requested', new Event($parameters, ));//->flush()->render();
    }

    public function getName()
    {
        return 'component';
    }
}
