<?php

/*
 * This file is part of the Bidla package.
 *
 * (c) Gesdinet. Marcos Gómez Vilches <marcos@gesdinet.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gesdinet\Bidla\VersionControl\Types;

use Gesdinet\Bidla\VersionControl\VersionControl;
use Symfony\Component\Process\Process;

class Git extends VersionControl
{
    public function setTags()
    {
        $process = new Process('git tag | sort -u');
        $process->run();

        $tags = $process->getOutput();
        $this->tags = array_filter(explode("\n", $tags));
    }

    public function setLogs()
    {
        $nextTag = null;
        $count = count($this->tags);

        if($count === 0) {
            throw new \Exception('No tags found in git repository');
        }

        for($i=0; $i<$count; $i++) {
            $process = new Process('git log --pretty="%h%x09%an%x09%s" ' . $nextTag . $this->tags[$i] . ' | grep -v "Merge branch"' . "\n\n");
            $process->run();

            $this->logs[$this->tags[$i]] = $process->getOutput();
            $nextTag = $this->tags[$i] . '..';
        }
    }

    public function setContributors()
    {
        $process = new Process('git shortlog HEAD -s -n');
        $process->run();

        $contributors = $process->getOutput();
        $this->contributors = array_filter(explode("\n", trim($contributors)));
    }
}