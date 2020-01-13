<?php

declare(strict_types=1);

namespace Arcanesoft\Seo\Http\Routes;

use Arcanesoft\Foundation\Support\Http\AdminRouteRegistrar;
use Closure;

/**
 * Class     AbstractRouteRegistrar
 *
 * @package  Arcanesoft\Seo\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class RouteRegistrar extends AdminRouteRegistrar
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
        $this->prefix('seo')
             ->name('seo.')
             ->group($callback);
    }
}