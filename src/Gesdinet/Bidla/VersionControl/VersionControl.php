<?php

/*
 * This file is part of the Bidla package.
 *
 * (c) Gesdinet. Marcos Gómez Vilches <marcos@gesdinet.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gesdinet\Bidla\VersionControl;

abstract class VersionControl
{
    protected $tags;
    protected $logs;
    protected $contributors;
    protected $releaseTag;

    protected abstract function setTags();

    protected abstract function setLogs();

    protected abstract function setContributors();

    public function getTags()
    {
        return $this->tags;
    }

    public function getLogs()
    {
        return $this->logs;
    }

    public function getContributors()
    {
        return $this->contributors;
    }

    public function setReleaseTag($tagname)
    {
        $this->releaseTag = $tagname;
    }

    public function getReleaseTag()
    {
        return $this->releaseTag;
    }
}