<?php

namespace Wj\DealerBundle\Component\Ui;

/**
 * @author Wouter J <wouter@wouterj.nl>
 */
class ReviewCreate extends Component
{
    public function __construct($templating, $view)
    {
        parent::__construct($templating, $view);
        $component = $this;

        $this->on('component.initialize', function () use ($component) {
            $component->on('component.requested', 'getComponent');
        });
    }

    public function getComponent(GenericEvent $event)
    {
    }
}
