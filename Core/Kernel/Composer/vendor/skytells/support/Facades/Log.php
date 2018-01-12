<?php

namespace Skytells\Support\Facades;

use Psr\Log\LoggerInterface;

/**
 * @see \Skytells\Log\Writer
 */
class Log extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return LoggerInterface::class;
    }
}
