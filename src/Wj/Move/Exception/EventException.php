<?php

namespace Wj\Move\Exception;

/**
 * @author Wouter J <wouter@wouterj.nl>
 */
class EventException extends \LogicException implements MoveException
{
    const LISTENER_NOT_CALLABLE = 1;

    public static function listenerNotCallable($event, $callable)
    {
        return new self(
            sprintf('The listener for event "%s" is not a valid callable, "%s" given.', $event, $callable),
            self::LISTENER_NOT_CALLABLE
        );
    }
}