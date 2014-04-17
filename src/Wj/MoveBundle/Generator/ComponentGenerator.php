<?php

namespace Wj\MoveBundle\Generator;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\DependencyInjection\Container;
use Sensio\Bundle\GeneratorBundle\Generator\Generator;

/**
 * Generates a component.
 *
 * @author Wouter J <wouter@wouterj.nl>
 */
class ComponentGenerator extends Generator
{
    private $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function generate($namespace, $class, $path)
    {
        if (file_exists($path)) {
            if (!is_dir($path)) {
                throw new \RuntimeException(sprintf('Unable to generate the component as the target file "%s" already exists.', realpath($path)));
            }
            if (!is_writable($path)) {
                throw new \RuntimeException(sprintf('Unable to generate the component as the target file "%s" is not writable.', realpath($path)));
            }
        }

        $this->renderFile('Component.php.twig', $path, array(
            'namespace' => $namespace,
            'class'     => $class,
        ));
    }
}

