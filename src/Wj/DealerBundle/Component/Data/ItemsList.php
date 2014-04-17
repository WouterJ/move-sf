<?php

namespace Wj\DealerBundle\Component\Data;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * @author Wouter J <wouter@wouterj.nl>
 */
class ItemsList extends Component
{
    public function __construct($modelClass)
    {
        parent::__construct($modelClass);

        $component = $this;

        $this->on('component.initialize', function () use ($component) {
            $component->on('ui.items_list_requested', 'getItems');
        });
    }

    public function getItems()
    {
        $model = $this->modelClass;
        $event = new GenericEvent(null, array('items' => $model::all()));

        $this->trigger('data.items_list_served', $event);
    }
}
