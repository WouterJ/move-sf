<?php

namespace Wj\MoveBundle\Command;

use Wj\MoveBundle\Generator\ComponentGenerator;
use Sensio\Bundle\GeneratorBundle\Command\GeneratorCommand;
use Sensio\Bundle\GeneratorBundle\Command\Helper\DialogHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;

/**
 * Generates components.
 *
 * @author Wouter J <wouter@wouterj.nl>
 */
class GenerateComponentCommand extends GeneratorCommand
{
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setDefinition(array(
                new InputArgument('name', InputArgument::REQUIRED, 'The Bundle:Type:Name syntax of the component to create'),
            ))
            ->setDescription('Generates a component')
            ->setHelp(<<<EOT
The <info>%command.name%</info> command helps you generates new bundles.

It takes the component shortname (<comment>Bundle:Type:Name</comment>) syntax:

<info>php %command.full_name% Acme\BlogBundle\Component\Ui\ShowBlog</info>
EOT
            )
            ->setName('generate:component')
        ;
    }

    /**
     * {@inheritDoc}
     *
     * @throws \InvalidArgumentException When an invalid component name is provided
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dialog = $this->getDialogHelper();

        $data = $this->parseName($input->getArgument('name'));

        $dialog->writeSection($output, 'Component generation');

        if (!$this->getContainer()->get('filesystem')->isAbsolutePath($data['path'])) {
            $data['path'] = getcwd().'/'.$data['path'];
        }

        $generator = $this->getGenerator($data['bundle']);
        $generator->generate($data['namespace'], $data['class'], $data['path']);

        $output->writeln('Generating the component code: <info>OK</info>');
    }

    protected function createGenerator()
    {
        return new ComponentGenerator($this->getContainer()->get('filesystem'));
    }

    protected function parseName($name)
    {
        list($bundle, $type, $name) = explode(':', $name, 3);
        $bundle = $this->getContainer()->get('kernel')->getBundle($bundle);

        return array(
            'bundle' => $bundle,
            'type' => $type,
            'fqcn' => sprintf(
                '%s\\Component\\%s\\%s',
                $bundle->getNamespace(),
                $type,
                $name
            ),
            'class' => $name,
            'namespace' => sprintf(
                '%s\\Component\\%s',
                $bundle->getNamespace(),
                $type
            ),
            'path' => sprintf(
                '%s/Component/%s/%s.php',
                $bundle->getPath(),
                $type,
                $name
            ),
        );
    }

    protected function getSkeletonDirs(BundleInterface $bundle = null)
    {
        $skeletonDirs = array();

        if (isset($bundle) && is_dir($dir = $bundle->getPath().'/Resources/WjMoveBundle/skeleton')) {
            $skeletonDirs[] = $dir;
        }

        if (is_dir($dir = $this->getContainer()->get('kernel')->getRootdir().'/Resources/WjMoveBundle/skeleton')) {
            $skeletonDirs[] = $dir;
        }

        $skeletonDirs[] = __DIR__.'/../Resources/skeleton';
        $skeletonDirs[] = __DIR__.'/../Resources';

        return $skeletonDirs;
    }
}
