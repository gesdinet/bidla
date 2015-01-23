<?php

/*
 * This file is part of the Bidla package.
 *
 * (c) Gesdinet. Marcos Gómez Vilches <marcos@gesdinet.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gesdinet\Bidla\File;

use Symfony\Component\Filesystem\Filesystem;

abstract class File
{
    protected $output;
    protected $filename;

    public function write()
    {
        $fs = new Filesystem();
        $fs->dumpFile($this->filename, $this->output);
    }

    public function getOutput()
    {
        return $this->output;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function setFilename($name)
    {
        $this->filename = $name;
    }

    abstract function generator($input);
}