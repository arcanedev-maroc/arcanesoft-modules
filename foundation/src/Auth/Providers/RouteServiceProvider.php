<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Providers;

use Arcanesoft\Foundation\Auth\Http\Routes;
use Arcanesoft\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

/**
 * Class     RouteServiceProvider
 *
 * @package  Arcanesoft\Foundation\Auth\Providers
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
        Routes\UsersRoutes::class,
        Routes\AdministratorsRoutes::class,
        Routes\RolesRoutes::class,
        Routes\PermissionsRoutes::class,
        Routes\PasswordResetsRoutes::class,
        Routes\SettingsRoutes::class,
        Routes\ProfileRoutes::class,
    ];
}
