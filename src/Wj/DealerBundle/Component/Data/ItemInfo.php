<?php

namespace Wj\DealerBundle\Component\Data;

use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * @author Wouter J <wouter@wouterj.nl>
 */
class ItemInfo extends Component
{
    public function __construct($modelClass)
    {
        parent::__construct($modelClass);

        $component = $this;

        $this->on('component.initialize', function () use ($component) {
            $component->on('ui.item_requested', 'getItem');
        });
    }

    public function getItem(GenericEvent $event)
    {
        $id = $event->getArgument('id');
        $model = $this->modelClass;

        $this->trigger('data.item_served', new GenericEvent(null, array('item' => $model::find($id))));
    }
}
