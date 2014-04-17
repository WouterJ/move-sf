<?php

namespace Wj\DealerBundle\Component\Ui;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * @author Wouter J <wouter@wouterj.nl>
 */
class ItemsList extends Component
{
    public function __construct($templating, $view)
    {
        parent::__construct($templating, $view);
        $component = $this;

        $this->on('component.initialize', function () use ($component) {
            $component->on('component.requested', 'getComponent');
            $component->on('data.items_list_served', 'renderItems');
        });
    }

    public function getComponent()
    {
        $this->trigger('ui.items_list_requested');
    }

    public function renderItems(GenericEvent $event)
    {
        if ($event->hasArgument('items')) {
            $items = $event->getArgument('items');

            $event->getViewModel()->setSource('WjDealerBundle:Item:list.html.twig')->addParameters(array(
                'items' => $items,
            ));
        }
    }
}
