<?php namespace Arcanesoft\Foundation\Http\Routes;

use Arcanesoft\Foundation\Http\Controllers\DashboardController;

/**
 * Class     DashboardRoutes
 *
 * @package  Arcanesoft\Foundation\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DashboardRoutes extends RouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the routes.
     *
     * @return void
     */
    public function map(): void
    {
        $this->adminGroup(function () {
            $this->get('/', [DashboardController::class, 'index'])
                 ->name('index'); // admin::index
        });
    }
}
