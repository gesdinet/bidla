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

class ChangelogCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('changelog')
            ->setDescription('Generate changelog file')
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
                'Changelog file name?',
                'CHANGELOG.md'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vcstype = ucfirst($input->getArgument('vcs'));
        $filetype = 'Changelog'.ucfirst($input->getArgument('file'));

        try {
            $vcs = new \ReflectionClass(Bidla::PATH_VCS_TYPE . $vcstype);
        } catch (\ReflectionException $e) {
            $output->write(sprintf("<error>VCS type '%s' is not defined</error>\n", $vcstype));
            exit(1);
        }

        $vcs = $vcs->newInstance();

        try {
            $vcs->setTags();
            $vcs->setLogs();
        } catch (\Exception $e) {
            $output->write(sprintf("<error>%s</error>\n", $e->getMessage()));
            exit(1);
        }

        try {
            $file = new \ReflectionClass(Bidla::PATH_FILE_TYPE . $filetype);
        } catch (\ReflectionException $e) {
            $output->write(sprintf("<error>File type '%s' is not defined</error>\n", $filetype));
            exit(1);
        }

        $file = $file->newInstance();
        $file->generator($vcs->getLogs());

        $file->setFilename($input->getArgument('name'));
        $file->write();

        $output->write(sprintf("<info>Generated %s changelog file named %s</info>\n", $input->getArgument('file'), $input->getArgument('name')));
    }
}