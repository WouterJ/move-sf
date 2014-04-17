<?php

namespace Wj\DealerBundle\Component\Ui;

use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * @author Wouter J <wouter@wouterj.nl>
 */
class ReviewList extends Component
{
    public function __construct($templating, $view)
    {
        parent::__construct($templating, $view);
        $component = $this;

        $this->on('component.initialize', function () use ($component) {
            $component->on('component.requested', 'renderComponent');
            $component->on('data.review_list_served', 'renderReviews');
        });
    }

    public function renderComponent(GenericEvent $event)
    {
        if (!$event->hasArgument('item_id')) {
            throw new \InvalidArgumentException('No item_id given for review list');
        }

        $this->trigger('ui.review_list_requested', $event);
    }

    public function renderReviews(GenericEvent $event)
    {
        if ($event->hasArgument('reviews')) {
            $this->addResponse($this->getTemplating()->render('WjDealerBundle:Component:review_list.html.twig', array(
                'reviews' => $event->getArgument('reviews'),
            )));
        }
    }
}
