<?php namespace Arcanesoft\Auth\Base;

use Arcanesoft\Core\Http\RouteRegistrar as BaseRouteRegistrar;
use Closure;

/**
 * Class     RouteRegistrar
 *
 * @package  Arcanesoft\Auth\Base
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class RouteRegistrar extends BaseRouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Group routes under a module stack.
     *
     * @param  \Closure  $callback
     */
    protected function moduleGroup(Closure $callback)
    {
        $this->prefix('authorization')
             ->name('auth.')
             ->group($callback);
    }
}
