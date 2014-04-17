<?php

namespace Wj\DealerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @author Wouter J <wouter@wouterj.nl>
 */
class ItemController extends Controller
{
    public function showAction($id)
    {
        $this->get('wj_move.component_manager')->useComponent('item_info');
        $this->get('wj_move.component_manager')->useComponent('data.item_info');
        $this->get('wj_move.component_manager')->useComponent('review_list');
        $this->get('wj_move.component_manager')->useComponent('data.review_list');

        return $this->render('WjDealerBundle:Item:single.html.twig', array(
            'id' => $id,
        ));
    }
}
