<?php

namespace Skytells\Support\Facades;

/**
 * @see \Skytells\Cache\CacheManager
 * @see \Skytells\Cache\Repository
 */
class Cache extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cache';
    }
}
