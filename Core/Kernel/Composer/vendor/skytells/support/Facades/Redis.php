<?php

namespace Skytells\Support\Facades;

/**
 * @see \Skytells\Redis\RedisManager
 * @see \Skytells\Contracts\Redis\Factory
 */
class Redis extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'redis';
    }
}
