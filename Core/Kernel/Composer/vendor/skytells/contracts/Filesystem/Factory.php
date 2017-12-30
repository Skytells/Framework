<?php

namespace Skytells\Contracts\Filesystem;

interface Factory
{
    /**
     * Get a filesystem implementation.
     *
     * @param  string  $name
     * @return \Skytells\Contracts\Filesystem\Filesystem
     */
    public function disk($name = null);
}
