<?php

namespace Wj\AppBundle\Component;

use Wj\Move\Component;
use Wj\Move\Mixin\View;

/**
 * @author Wouter J <wouter@wouterj.nl>
 */
class Welcome extends Component
{
    public function __construct()
    {
        $this->on('initialize', array($this, 'getWelcomeText'));
    }

    public function getWelcomeText()
    {
        $this->addResponse('<h1>Hello World!</h1>');
    }
}