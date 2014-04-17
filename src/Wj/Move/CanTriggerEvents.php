<?php

namespace Wj\Move;

interface CanTriggerEvents
{
    /**
     * @param string $name
     * @param object $event An Event object
     */
    public function trigger($name, $event = null);
} 