<?php
/**
 * This file is part of the ConsoleKit package.
 *
 * @copyright (c) 2017 Skytells, Inc.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ConsoleKit;

interface TextWriter
{
    const STDOUT = 'stdout';
    const STDERR = 'stderr';

    /***
     * Outputs text
     * 
     * @param string $text
     */
    function write($test, $pipe = TextWriter::STDOUT);

    /***
     * Outputs text followed by a line break
     * 
     * @param string $text
     */
    function writeln($test = '', $pipe = TextWriter::STDOUT);
}
