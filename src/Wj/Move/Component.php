<?php

namespace Wj\Move;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Wj\Move\Exception\EventException;

/**
 * @author Wouter J <wouter@wouterj.nl>
 */
abstract class Component implements CanAttachToEvents, CanTriggerEvents
{
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;
    /**
     * @var EventDispatcherInterface
     */
    private $innerDispatcher;

    public function setDispatcher(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
        $dispatcher->addListener('~*', array($this, 'dispatch'));
    }

    private function getDispatcher()
    {
        return $this->dispatcher;
    }

    public function setInnerDispatcher(EventDispatcherInterface $dispatcher)
    {
        $this->innerDispatcher = $dispatcher;
    }

    protected function getInnerDispatcher()
    {
        if (null === $this->innerDispatcher) {
            var_dump('['.get_class($this).'] set inner dispatcher');
            $this->setInnerDispatcher(new EventDispatcher());
        }

        return $this->innerDispatcher;
    }

    public function trigger($name, $event = null)
    {
        var_dump('['.get_class($this).'] trigger '.$name);
        if (0 === strpos($name, 'component')) {
            $dispatcher = $this->getInnerDispatcher();
        } else {
            $dispatcher = $this->getDispatcher();
        }

        return $dispatcher->dispatch($name, $event);
    }

    public function on($name, $callable)
    {
        var_dump('['.get_class($this).'] attach '.$name);
        if (!is_callable($callable)) {
            $callable = array($this, $callable);

            if (!is_callable($callable)) {
                throw EventException::listenerNotCallable($name, $callable);
            }
        }

        $this->getInnerDispatcher()->addListener($name, $callable);
    }

    public function dispatch(Event $event)
    {
        var_dump('['.get_class($this).'] dispatch '.$event->getName());
        $this->getInnerDispatcher()->dispatch($event->getName(), $event);
    }
}
