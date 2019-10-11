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
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The routes list.
     *
     * @var array
     */
    protected $routeClasses = [
        Routes\DashboardRoutes::class,
        Routes\MetricsRoutes::class,
        Routes\ApiRoutes::class,
    ];
}