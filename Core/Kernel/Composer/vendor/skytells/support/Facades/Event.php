<?php

namespace Skytells\Support\Facades;

use Skytells\Database\Eloquent\Model;
use Skytells\Support\Testing\Fakes\EventFake;

/**
 * @see \Skytells\Events\Dispatcher
 */
class Event extends Facade
{
    /**
     * Replace the bound instance with a fake.
     *
     * @return void
     */
    public static function fake()
    {
        static::swap($fake = new EventFake);

        Model::setEventDispatcher($fake);
    }

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'events';
    }
}
