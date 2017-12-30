<?php

namespace Skytells\Support\Facades;

use Skytells\Contracts\Auth\Access\Gate as GateContract;

/**
 * @see \Skytells\Contracts\Auth\Access\Gate
 */
class Gate extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return GateContract::class;
    }
}
