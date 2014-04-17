<?php

namespace Wj\DealerBundle\Component\Data;

use Wj\Move\Component as BaseComponent;

class Component extends BaseComponent
{
    protected $modelClass;

    public function __construct($modelClass)
    {
        $this->modelClass = $modelClass;
    }
}
