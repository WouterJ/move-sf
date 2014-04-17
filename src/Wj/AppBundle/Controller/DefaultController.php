<?php

namespace Wj\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author Wouter J <wouter@wouterj.nl>
 */
class DefaultController extends Controller
{
    public function indexAction()
    {
        $this->get('wj_move.component_manager')->useComponent('items_list');
        $this->get('wj_move.component_manager')->useComponent('data.items_list');

        return $this->render('WjAppBundle::home.html.twig');
    }
}
