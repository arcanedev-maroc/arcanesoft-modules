<?php

namespace Arcanesoft\Support\Routing\Concerns;

/**
 * Trait     HasRouteClasses
 *
 * @package  Arcanesoft\Support\Routing\Concerns
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait HasRouteClasses
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map route classes.
     *
     * @param  array  $routes
     */
    protected static function mapRouteClasses(array $routes): void
    {
        static::callRoutesClassMethod($routes, 'map');
    }

    /**
     * Bind route classes.
     *
     * @param  array  $routes
     */
    protected static function bindRouteClasses(array $routes): void
    {
        static::callRoutesClassMethod($routes, 'bindings');
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Call the route method.
     *
     * @param  string  $route
     * @param  string  $method
     */
    private static function callRoutesClassMethod(array $routes, string $method): void
    {
        /** @var  \Illuminate\Contracts\Foundation\Application  $app */
        $app = app();

        foreach ($routes as $route) {
            if (method_exists($route, $method)) {
                $app->call($route.'@'.$method);
            }
        }
    }
}