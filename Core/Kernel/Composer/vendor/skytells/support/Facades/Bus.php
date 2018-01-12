<?php

namespace Skytells\Support\Facades;

use Skytells\Support\Testing\Fakes\BusFake;
use Skytells\Contracts\Bus\Dispatcher as BusDispatcherContract;

/**
 * @see \Skytells\Contracts\Bus\Dispatcher
 */
class Bus extends Facade
{
    /**
     * Replace the bound instance with a fake.
     *
     * @return void
     */
    public static function fake()
    {
        static::swap(new BusFake);
    }

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return BusDispatcherContract::class;
    }
}
