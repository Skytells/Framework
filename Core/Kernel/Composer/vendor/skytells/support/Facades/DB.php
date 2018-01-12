<?php

namespace Skytells\Support\Facades;

/**
 * @see \Skytells\Database\DatabaseManager
 * @see \Skytells\Database\Connection
 */
class DB extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'db';
    }
}
