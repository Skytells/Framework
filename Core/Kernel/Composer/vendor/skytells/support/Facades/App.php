<?php

namespace Skytells\Support\Facades;

/**
 * @method static string version()
 * @method static string basePath()
 * @method static string environment()
 * @method static bool isDownForMaintenance()
 * @method static void registerConfiguredProviders()
 * @method static \Skytells\Support\ServiceProvider register(\Skytells\Support\ServiceProvider|string $provider, array $options = [], bool $force = false)
 * @method static void registerDeferredProvider(string $provider, string $service = null)
 * @method static void boot()
 * @method static void booting(mixed $callback)
 * @method static void booted(mixed $callback)
 * @method static string getCachedServicesPath()
 *
 * @see \Skytells\Foundation\Application
 */
class App extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'app';
    }
}
