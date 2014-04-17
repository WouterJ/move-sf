<?php

namespace Wj\DealerBundle\Component\Ui;

use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * @author Wouter J <wouter@wouterj.nl>
 */
class ItemInfo extends Component
{
    public function __construct($templating, $view)
    {
        parent::__construct($templating, $view);
        $component = $this;

        $this->on('component.initialize', function () use ($component) {
            $component->on('component.requested', 'getComponent');
            $component->on('data.item_served', 'renderItem');
        });
    }

    public function getComponent(GenericEvent $event)
    {
        if (!$event->hasArgument('id')) {
            throw new \InvalidArgumentException('No ID found to render info component');
        }

        $this->trigger('ui.item_requested', $event);
    }

    public function renderItem(GenericEvent $event)
    {
        $event->getView()->addBody($this->getTemplating()->render('WjDealerBundle:Component:item_info.html.twig', array(
            'item' => $event->getArgument('item')
        )));
    }
}
