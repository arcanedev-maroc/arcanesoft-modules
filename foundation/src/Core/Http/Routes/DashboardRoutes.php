<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Routes;

use Arcanesoft\Foundation\Core\Http\Controllers\DashboardController;

/**
 * Class     DashboardRoutes
 *
 * @package  Arcanesoft\Foundation\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DashboardRoutes extends AbstractRouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the routes.
     */
    public function map(): void
    {
        $this->adminGroup(function () {
            // admin::index
            $this->get('/', [DashboardController::class, 'index'])
                 ->name('index');
        });
    }
}
