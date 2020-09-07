<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Routes\Web;

use Arcanesoft\Foundation\Core\Http\Controllers\DashboardController;
use Arcanesoft\Foundation\Core\Http\Routes\AbstractRouteRegistrar;

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
        // admin::index
        $this->get('/', [DashboardController::class, 'index'])
             ->name('index');
    }
}