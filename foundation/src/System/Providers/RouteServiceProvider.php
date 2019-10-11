<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Providers;

use Arcanesoft\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Arcanesoft\Foundation\System\Http\Routes;

/**
 * Class     RouteServiceProvider
 *
 * @package  Arcanesoft\Foundation\System\Providers
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
        Routes\SystemRoutes::class,
        Routes\MaintenanceRoutes::class,
        Routes\AbilitiesRoutes::class,
        Routes\LogViewerRoutes::class,
        Routes\RoutesViewer::class,
    ];
}
