<?php

namespace Skytells\Support\Facades;

use Skytells\Contracts\Routing\ResponseFactory as ResponseFactoryContract;

/**
 * @see \Skytells\Contracts\Routing\ResponseFactory
 */
class Response extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ResponseFactoryContract::class;
    }
}
