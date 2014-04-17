<?php

namespace Wj\MoveBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Wj\MoveBundle\DependencyInjection\Compiler\ComponentsPass;

class WjMoveBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ComponentsPass());
    }
}
