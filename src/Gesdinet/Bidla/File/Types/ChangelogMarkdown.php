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

class ChangelogMarkdown extends File
{
    public function generator($input)
    {
        $logs = array_reverse($input);

        $this->output = "#Changelog\n";

        foreach($logs as $tag => $commits) {
            $this->output .= '#### [' . $tag . ']' . "(../../releases/tag/$tag)\n";
            $this->output .= $commits;
            $this->output .= "\n";
        }

        $this->markDownGenerator();
    }

    public function markDownGenerator()
    {
        $this->output = preg_replace('/^(.*?)\t/m', ' * [$1](../../commit/$1)', $this->output);
        $this->output = preg_replace('/#([0-9]+)/m', ' [#$1](../../issues/$1)', $this->output);
        $this->output = preg_replace('/\)(.*?)\t/m', ') - __($1)__ ', $this->output);
    }
}