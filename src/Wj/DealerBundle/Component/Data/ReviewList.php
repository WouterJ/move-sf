<?php

namespace Wj\DealerBundle\Component\Data;

use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * @author Wouter J <wouter@wouterj.nl>
 */
class ReviewList extends Component
{
    public function __construct($modelClass)
    {
        parent::__construct($modelClass);

        $component = $this;

        $this->on('component.initialize', function () use ($component) {
            $component->on('ui.review_list_requested', 'getReviews');
        });
    }

    public function getReviews(GenericEvent $event)
    {
        $id = $event->getArgument('item_id');
        $model = $this->modelClass;

        $this->trigger('data.review_list_served', new GenericEvent(null, array('reviews' => $model::find($id)->reviews()->limit(5))));
    }
}
