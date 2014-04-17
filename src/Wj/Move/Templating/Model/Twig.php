<?php

namespace Wj\Move\Templating\Model;

class Twig extends AbstractModel
{
    /** @var \Twig_Environment */
    private $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function render()
    {
        return $this->twig->render($this->getSource(), $this->getParameters());
    }
}
