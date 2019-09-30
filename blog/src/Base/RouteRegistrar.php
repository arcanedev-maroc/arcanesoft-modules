<?php namespace Arcanesoft\Blog\Base;

use Arcanesoft\Core\Http\RouteRegistrar as BaseRouteRegistrar;
use Closure;

/**
 * Class     RouteRegistrar
 *
 * @package  Arcanesoft\Blog\Base
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
        $this->prefix('blog')
             ->name('blog.')
             ->group($callback);
    }
}
