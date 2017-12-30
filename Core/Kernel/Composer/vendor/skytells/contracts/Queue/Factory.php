<?php

namespace Skytells\Contracts\Queue;

interface Factory
{
    /**
     * Resolve a queue connection instance.
     *
     * @param  string  $name
     * @return \Skytells\Contracts\Queue\Queue
     */
    public function connection($name = null);
}
