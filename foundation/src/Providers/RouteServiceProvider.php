<?php

namespace Arcanesoft\Foundation\Providers;

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
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The routes list.
     *
     * @var array
     */
    protected $routes = [
        Routes\DashboardRoutes::class,
        Routes\SystemRoutes::class,
        Routes\MetricsRoutes::class,
        Routes\ProfileRoutes::class,

        Routes\ApiRoutes::class,
    ];
}
