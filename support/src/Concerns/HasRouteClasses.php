<?php namespace Arcanesoft\Support\Concerns;

/**
 * Trait     HasRouteClasses
 *
 * @package  Arcanesoft\Support\Concerns
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait HasRouteClasses
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map the route classes.
     *
     * @param  array   $routes
     * @param  string  $method
     *
     * @return void
     */
    protected static function mapRoutes(array $routes, $method = 'map')
    {
        static::callMethodIfExistsInRoutes($routes, $method);
    }

    /**
     * Bind the route classes.
     *
     * @param  array   $routes
     * @param  string  $method
     *
     * @return void
     */
    protected static function bindRoutes(array $routes, $method = 'bindings')
    {
        static::callMethodIfExistsInRoutes($routes, $method);
    }

    /**
     * Call a RouteRegistrar's method if exists.
     *
     * @param  array   $routes
     * @param  string  $method
     *
     * @return void
     */
    protected static function callMethodIfExistsInRoutes(array $routes, $method)
    {
        foreach ($routes as $route) {
            if (method_exists($route, $method))
                (new $route)->{$method}();
        }
    }
}
