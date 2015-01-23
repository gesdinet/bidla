<?php

/*
 * This file is part of the Bidla package.
 *
 * (c) Gesdinet. Marcos Gómez Vilches <marcos@gesdinet.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gesdinet\Bidla\Console;

use Gesdinet\Bidla\Bidla;
use Gesdinet\Bidla\Console\Command\ChangelogCommand;
use Gesdinet\Bidla\Console\Command\ContributorsCommand;
use Gesdinet\Bidla\Console\Command\UpdateCommand;
use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
    * Constructor.
    */
    public function __construct()
    {
        error_reporting(-1);
        parent::__construct('Bidla', Bidla::VERSION);
        $this->add(new ChangelogCommand());
        $this->add(new ContributorsCommand());
        $this->add(new UpdateCommand());
    }
    public function getLongVersion()
    {
        $version = parent::getLongVersion().' by <comment>Gesdinet</comment>';
        $commit  = '@git-commit@';
        if ('@'.'git-commit@' !== $commit) {
        $version .= ' ('.substr($commit, 0, 7).')';
        }
        return $version;
    }
}