<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Support\Http;

use Arcanedev\Support\Routing\RouteRegistrar;
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
     * Get the admin name.
     *
     * @return string
     */
    protected function getAdminName(): string
    {
        return 'admin::';
    }

    /**
     * Get the admin middleware.
     *
     * @return array
     */
    protected function getAdminMiddleware(): array
    {
        return [
            'web',
            'arcanesoft',
        ];
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
             ->name($this->getAdminName())
             ->group($this->prepareModuleCallback($callback));
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
