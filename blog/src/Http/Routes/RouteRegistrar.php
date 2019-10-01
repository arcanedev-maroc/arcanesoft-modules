<?php

namespace Arcanesoft\Blog\Http\Routes;

use Arcanesoft\Foundation\Core\Http\RouteRegistrar as BaseRouteRegistrar;
use Closure;

/**
 * Class     RouteRegistrar
 *
 * @package  Arcanesoft\Blog\Http\Routes
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
    protected function moduleGroup(Closure $callback): void
    {
        $this->prefix('blog')
             ->name('blog.')
             ->group($callback);
    }
}
