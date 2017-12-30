<?php

namespace Skytells\Support\Facades;

/**
 * @method static \Skytells\Database\Schema\Builder create(string $table, \Closure $callback)
 * @method static \Skytells\Database\Schema\Builder drop(string $table)
 * @method static \Skytells\Database\Schema\Builder dropIfExists(string $table)
 * @method static \Skytells\Database\Schema\Builder table(string $table, \Closure $callback)
 *
 * @see \Skytells\Database\Schema\Builder
 */
class Schema extends Facade
{
    /**
     * Get a schema builder instance for a connection.
     *
     * @param  string  $name
     * @return \Skytells\Database\Schema\Builder
     */
    public static function connection($name)
    {
        return static::$app['db']->connection($name)->getSchemaBuilder();
    }

    /**
     * Get a schema builder instance for the default connection.
     *
     * @return \Skytells\Database\Schema\Builder
     */
    protected static function getFacadeAccessor()
    {
        return static::$app['db']->connection()->getSchemaBuilder();
    }
}
