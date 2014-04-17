<?php

namespace Wj\Move\Exception;

/**
 * @author Wouter J <wouter@wouterj.nl>
 */
class ComponentException extends \LogicException implements MoveException
{
    const ALREADY_EXISTS  = 1;
    const NOT_EXISTS      = 2;
    const NOT_INITIALIZED = 3;

    public static function alreadyExists($name)
    {
        return new self(sprintf('Component alias "%s" does already exists.', $name), self::ALREADY_EXISTS);
    }

    public static function doesNotExists($name)
    {
        return new self(sprintf('Component "%s" does not exists.', $name), self::NOT_EXISTS);
    }

    public static function isNotInitialized($name)
    {
        return new self(sprintf('Component "%s" is not initialized.', $name), self::NOT_INITIALIZED);
    }
}