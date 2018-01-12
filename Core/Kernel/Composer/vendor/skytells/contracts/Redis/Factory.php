<?php

namespace Skytells\Contracts\Redis;

interface Factory
{
    /**
     * Get a Redis connection by name.
     *
     * @param  string  $name
     * @return \Skytells\Redis\Connections\Connection
     */
    public function connection($name = null);
}
