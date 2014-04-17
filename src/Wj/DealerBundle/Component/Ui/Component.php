<?php

namespace Wj\DealerBundle\Component\Ui;

use Symfony\Component\Templating\EngineInterface;
use Wj\Move\Mixin;
use Wj\Move\Component as BaseComponent;
use Wj\Move\Templating\Model\ViewModel;

/**
 * @author Wouter J <wouter@wouterj.nl>
 */
abstract class Component extends BaseComponent
{
    /** @var EngineInterface */
    private $templating;

    /**
     * @param EngineInterface $templating
     */
    public function __construct($templating)
    {
        $this->setTemplating($templating);
    }

    /**
     * @return EngineInterface
     */
    protected function getTemplating()
    {
        return $this->templating;
    }

    private function setTemplating(EngineInterface $templating)
    {
        $this->templating = $templating;
    }
}
