<?php

namespace Skytells\Support\Facades;

use Skytells\Support\Testing\Fakes\QueueFake;

/**
 * @see \Skytells\Queue\QueueManager
 * @see \Skytells\Queue\Queue
 */
class Queue extends Facade
{
    /**
     * Replace the bound instance with a fake.
     *
     * @return void
     */
    public static function fake()
    {
        static::swap(new QueueFake(static::getFacadeApplication()));
    }

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'queue';
    }
}
