<?php

namespace Wj\Move;

interface CanAttachToEvents
{
    public function on($name, $callable);
}