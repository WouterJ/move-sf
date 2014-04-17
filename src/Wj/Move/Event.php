<?php

namespace Wj\Move;

use Wj\Move\Templating\Model\Twig as TwigViewModel;
use Symfony\Component\EventDispatcher\GenericEvent;

class Event extends GenericEvent
{
    /** @var ViewModel */
    private static $view;

    /**
     * @param array          $parameters
     * @param null|ViewModel $viewModel
     */
    public function __construct(array $parameters = array(), $viewModel = null)
    {
        parent::__construct(null, $parameters);

        if (null !== $viewModel) {
            $this->setViewModel($viewModel);
        }
    }

    public function setViewModel(ViewModel $view)
    {
        self::$view = $view;
    }

    public function getViewModel()
    {
        return self::$view;
    }
}
