<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Providers;

use Arcanesoft\Foundation\Core\Http\Routes;
use Arcanesoft\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

/**
 * Class     RouteServiceProvider
 *
 * @package  Arcanesoft\Foundation\Core\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RouteServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the registered routes.
     *
     * @return array
     */
    public function routeClasses(): array
    {
        return [
            Routes\DashboardRoutes::class,
            Routes\MetricsRoutes::class,
            Routes\ApiRoutes::class,
        ];
    }

    /**
     * @inheritDoc
     */
    public function boot(): void
    {
        parent::boot();

        $this->registerMiddleware($this->app['router']);
    }

    /**
     * Register middleware classes.
     *
     * @param  \Illuminate\Routing\Router  $router
     */
    private function registerMiddleware($router)
    {
        $config = (array) $this->app['config']['arcanesoft.foundation.http.middleware'];

        foreach ($config as $group => $middleware) {
            if (is_array($middleware))
                $router->middlewareGroup($group, $middleware);
            else
                $router->pushMiddlewareToGroup($group, $middleware);
        }
    }
}
