<?php

namespace Arcanesoft\Foundation\Core\Http;

use Arcanesoft\Support\Routing\RouteRegistrar as BaseRouteRegistrar;
use Closure;

/**
 * Class     RouteRegistrar
 *
 * @package  Arcanesoft\Foundation\Core\Http
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class RouteRegistrar extends BaseRouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Getters
     | -----------------------------------------------------------------
     */

    /**
     * Get the admin prefix.
     *
     * @return string
     */
    protected function getAdminPrefix(): string
    {
        return 'admin';
    }

    /**
     * Get the admin middleware.
     *
     * @return array
     */
    protected function getAdminMiddleware(): array
    {
        return ['web', 'auth', 'activated', 'admin'];
    }

    /**
     * Get the admin route name (prefixed name).
     *
     * @return string
     */
    protected function getAdminName(): string
    {
        return 'admin::';
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Group the routes under the admin stack.
     *
     * @param  \Closure  $callback
     */
    protected function adminGroup(Closure $callback)
    {
        if (method_exists($this, 'moduleGroup'))
            $callback = function () use ($callback) {
                $this->moduleGroup($callback);
            };

        $this->prefix($this->getAdminPrefix())
            ->middleware($this->getAdminMiddleware())
            ->name($this->getAdminName())
            ->group($callback);
    }

    /**
     * Group the route under the datatables stack.
     *
     * @param  \Closure  $callback
     */
    protected function dataTableGroup(Closure $callback)
    {
        $this->prefix('datatables')
            ->name('datatables.')
            ->middleware(['ajax'])
            ->group($callback);
    }
}