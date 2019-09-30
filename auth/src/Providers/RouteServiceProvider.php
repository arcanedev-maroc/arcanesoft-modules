<?php namespace Arcanesoft\Auth\Providers;

use Arcanesoft\Auth\Http\Routes;
use Arcanesoft\Support\Providers\RouteServiceProvider as ServiceProvider;

/**
 * Class     RouteServiceProvider
 *
 * @package  Arcanesoft\Auth\Providers
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
            Routes\UsersRoutes::class,
            Routes\RolesRoutes::class,
            Routes\PermissionsRoutes::class,
            Routes\PasswordResetsRoutes::class,
        ];
    }
}
