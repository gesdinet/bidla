<?php

/*
 * This file is part of the Bidla package.
 *
 * (c) Gesdinet. Marcos Gómez Vilches <marcos@gesdinet.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gesdinet\Bidla\Console\Command;

use Gesdinet\Bidla\Bidla;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ContributorsCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('contributors')
            ->setDescription('Generate contributors file')
            ->addArgument(
                'vcs',
                InputArgument::OPTIONAL,
                'Version control system',
                'git'
            )
            ->addArgument(
                'file',
                InputArgument::OPTIONAL,
                'file output',
                'markdown'
            )
            ->addArgument(
                'name',
                InputArgument::OPTIONAL,
                'Contributors file name?',
                'CONTRIBUTORS.md'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vcstype = ucfirst($input->getArgument('vcs'));
        $filetype = 'Contributors'.ucfirst($input->getArgument('file'));

        try {
            $vcs = new \ReflectionClass(Bidla::PATH_VCS_TYPE . $vcstype);
        } catch (\ReflectionException $e) {
            $output->write(sprintf("<error>VCS type '%s' is not defined</error>\n", $vcstype));
            exit(1);
        }

        $vcs = $vcs->newInstance();

        $vcs->setContributors();

        try {
            $file = new \ReflectionClass(Bidla::PATH_FILE_TYPE . $filetype);
        } catch (\ReflectionException $e) {
            $output->write(sprintf("<error>File type '%s' is not defined</error>\n", $filetype));
            exit(1);
        }

        $file = $file->newInstance();
        $file->generator($vcs->getContributors());

        $file->setFilename($input->getArgument('name'));
        $file->write();

        $output->write(sprintf("<info>Generated %s contributors file named %s</info>\n", $input->getArgument('file'), $input->getArgument('name')));
    }
}