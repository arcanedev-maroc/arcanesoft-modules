<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Support\Http;

use Closure;

/**
 * Class     AdminRouteRegistrar
 *
 * @package  Arcanesoft\Foundation\Support\Http
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @method  void  moduleGroup(\Closure $callback)
 */
abstract class AdminRouteRegistrar extends RouteRegistrar
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
        return ['web', 'auth:admin', 'admin'];
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
        $this->prefix($this->getAdminPrefix())
             ->middleware($this->getAdminMiddleware())
             ->name('admin::')
             ->group($this->prepareModuleCallback($callback));
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

    /**
     * Prepare the module group's callback.
     *
     * @param  \Closure  $callback
     *
     * @return \Closure
     */
    private function prepareModuleCallback(Closure $callback): Closure
    {
        return method_exists($this, 'moduleGroup')
            ? function () use ($callback) { $this->moduleGroup($callback); }
            : $callback;
    }
}