<?php namespace Arcanesoft\Blog\Http\Routes;

use Arcanesoft\Blog\Base\RouteRegistrar;
use Arcanesoft\Blog\Http\Controllers\DashboardController;

/**
 * Class     DashboardRoutes
 *
 * @package  Arcanesoft\Blog\Http\Routes
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
                 ->name('index'); // admin::blog.index
        });
    }
}
