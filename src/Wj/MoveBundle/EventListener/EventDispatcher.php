<?php

namespace Wj\MoveBundle\EventListener;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher as Base;

/**
 * Extends Symfony2 event dispatcher with catch-all listeners.
 *
 * This class is taken from Behat TestWork 3, which is licensed with the MIT license.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
class EventDispatcher extends Base
{
    const BEFORE_ALL_EVENTS = '*~';
    const AFTER_ALL_EVENTS = '~*';

    /**
     * {@inheritdoc}
     */
    public function dispatch($eventName, Event $event = null)
    {
        if (null === $event) {
            $event = new Event();
        }

        if (method_exists($event, 'setName')) {
            $event->setName($eventName);
        }

        $this->doDispatch($this->getListeners($eventName), $eventName, $event);

        return $event;
    }

    /**
     * {@inheritdoc}
     */
    public function getListeners($eventName = null)
    {
        if (null == $eventName || self::BEFORE_ALL_EVENTS === $eventName) {
            return parent::getListeners($eventName);
        }

        return array_merge(
            parent::getListeners(self::BEFORE_ALL_EVENTS),
            parent::getListeners($eventName),
            parent::getListeners(self::AFTER_ALL_EVENTS)
        );
    }
}

