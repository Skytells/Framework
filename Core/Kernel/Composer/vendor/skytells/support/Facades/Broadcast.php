<?php

namespace Skytells\Support\Facades;

use Skytells\Contracts\Broadcasting\Factory as BroadcastingFactoryContract;

/**
 * @see \Skytells\Contracts\Broadcasting\Factory
 */
class Broadcast extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return BroadcastingFactoryContract::class;
    }
}
