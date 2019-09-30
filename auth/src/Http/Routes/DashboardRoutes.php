<?php namespace Arcanesoft\Auth\Http\Routes;

use Arcanesoft\Auth\Http\Controllers\DashboardController;
use Arcanesoft\Auth\Base\RouteRegistrar;

/**
 * Class     DashboardRoutes
 *
 * @package  Arcanesoft\Auth\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DashboardRoutes extends RouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map the routes.
     *
     * @return void
     */
    public function map(): void
    {
        $this->adminGroup(function () {
            $this->get('/', [DashboardController::class, 'index'])
                 ->name('index'); // admin::authorization.index
        });
    }
}
