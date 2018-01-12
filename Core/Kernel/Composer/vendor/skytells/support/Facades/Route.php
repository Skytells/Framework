<?php

namespace Skytells\Support\Facades;

/**
 * @method static \Skytells\Routing\Route get(string $uri, \Closure|array|string|null $action = null)
 * @method static \Skytells\Routing\Route post(string $uri, \Closure|array|string|null $action = null)
 * @method static \Skytells\Routing\Route put(string $uri, \Closure|array|string|null $action = null)
 * @method static \Skytells\Routing\Route delete(string $uri, \Closure|array|string|null $action = null)
 * @method static \Skytells\Routing\Route patch(string $uri, \Closure|array|string|null $action = null)
 * @method static \Skytells\Routing\Route options(string $uri, \Closure|array|string|null $action = null)
 * @method static \Skytells\Routing\Route any(string $uri, \Closure|array|string|null $action = null)
 * @method static \Skytells\Routing\Route match(array|string $methods, string $uri, \Closure|array|string|null $action = null)
 * @method static \Skytells\Routing\Route prefix(string  $prefix)
 * @method static void resource(string $name, string $controller, array $options = [])
 * @method static void apiResource(string $name, string $controller, array $options = [])
 * @method static void group(array $attributes, \Closure|string $callback)
 * @method static \Skytells\Routing\Route middleware(array|string|null $middleware)
 * @method static \Skytells\Routing\Route substituteBindings(\Skytells\Routing\Route $route)
 * @method static void substituteImplicitBindings(\Skytells\Routing\Route $route)
 *
 * @see \Skytells\Routing\Router
 */
class Route extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'router';
    }
}
