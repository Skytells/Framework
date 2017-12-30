<?php

namespace Skytells\Support\Facades;

/**
 * @see \Skytells\Session\SessionManager
 * @see \Skytells\Session\Store
 */
class Session extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'session';
    }
}
