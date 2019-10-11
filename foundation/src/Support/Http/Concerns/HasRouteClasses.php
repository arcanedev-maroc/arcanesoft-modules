<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Support\Http\Concerns;

/**
 * Trait     HasRouteClasses
 *
 * @package  Arcanesoft\Foundation\Support\Http\Concerns
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
     * @param  iterable  $routes
     */
    protected static function mapRouteClasses(iterable $routes): void
    {
        static::callRoutesClassMethod($routes, 'map');
    }

    /**
     * Bind route classes.
     *
     * @param  iterable  $routes
     */
    protected static function bindRouteClasses(iterable $routes): void
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
     * @param  iterable  $routes
     * @param  string    $method
     */
    private static function callRoutesClassMethod(iterable $routes, string $method): void
    {
        foreach ($routes as $route) {
            if (method_exists($route, $method)) {
                app()->call($route.'@'.$method);
            }
        }
    }
}