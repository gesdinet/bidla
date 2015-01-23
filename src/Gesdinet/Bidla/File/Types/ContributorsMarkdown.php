<?php

/*
 * This file is part of the Bidla package.
 *
 * (c) Gesdinet. Marcos Gómez Vilches <marcos@gesdinet.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gesdinet\Bidla\File\Types;

use Gesdinet\Bidla\File\File;

class ContributorsMarkdown extends File
{
    public function generator($input)
    {
        $contributors = array_reverse($input);

        $this->output = "#Contributors\n";

        foreach($contributors as $contributor) {
            $this->output .= "* ".$contributor."\n";
        }

        $this->markDownGenerator();
    }

    public function markDownGenerator()
    {
        $this->output = preg_replace('/([0-9]+)\t([^\s]+)$/m', '__$2__ - $1 commits', $this->output);

    }
}