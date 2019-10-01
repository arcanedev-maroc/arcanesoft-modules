<?php namespace Arcanesoft\Support\Routing;

use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Routing\Router;
use Illuminate\Support\Traits\ForwardsCalls;
use Arcanesoft\Support\Routing\Concerns\HasRouteClasses;

/**
 * Class     RouteRegistrar
 *
 * @package  Arcanesoft\Support\Routing
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @mixin  \Illuminate\Routing\RouteRegistrar
 *
 * @method  \Illuminate\Routing\RouteRegistrar  bind(string $key, \Closure $binder)
 *
 * @method  void  map()
 * @method  void  bindings()
 */
abstract class RouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasRouteClasses,
        ForwardsCalls;

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Pass dynamic methods onto the router instance.
     *
     * @param  string  $method
     * @param  array   $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->forwardCallToRouter(app(Router::class), $method, $parameters);
    }

    /**
     * Pass dynamic methods onto the router instance.
     *
     * @param  \Illuminate\Contracts\Routing\Registrar  $router
     * @param  string                                   $method
     * @param  array                                    $parameters
     *
     * @return mixed
     */
    protected function forwardCallToRouter(Registrar $router, $method, $parameters)
    {
        return $this->forwardCallTo($router, $method, $parameters);
    }
}
