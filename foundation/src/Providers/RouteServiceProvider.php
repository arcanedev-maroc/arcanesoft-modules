<?php namespace Arcanesoft\Foundation\Providers;

use Arcanesoft\Foundation\Http\Routes;
use Arcanesoft\Support\Providers\RouteServiceProvider as ServiceProvider;

/**
 * Class     RouteServiceProvider
 *
 * @package  Arcanesoft\Foundation\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RouteServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the routes.
     *
     * @return array
     */
    public function routes(): array
    {
        return [
            Routes\DashboardRoutes::class,
            Routes\SystemRoutes::class,
            Routes\MetricsRoutes::class,
            Routes\ProfileRoutes::class,

            Routes\ApiRoutes::class,
        ];
    }
}
