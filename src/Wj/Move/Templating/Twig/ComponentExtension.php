<?php

namespace Wj\Move\Templating\Twig;

use Wj\Move\Templating\ComponentHelper;

/**
 * @author Wouter J <wouter@wouterj.nl>
 */
class ComponentExtension extends \Twig_Extension
{
    private $helper;

    public function __construct(ComponentHelper $helper)
    {
        $this->helper = $helper;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('component', array($this->helper, 'render'), array('is_safe' => array('html'))),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'component';
    }
}