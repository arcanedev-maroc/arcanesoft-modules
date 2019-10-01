<?php

namespace Arcanesoft\Backups\Http\Routes;

use Arcanesoft\Backups\Http\Controllers\StatusesController;

/**
 * Class     StatusesRoutes
 *
 * @package  Arcanesoft\Backups\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class StatusesRoutes extends RouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map the routes for the application.
     */
    public function map()
    {
        $this->adminGroup(function () {
            $this->prefix('statuses')->as('statuses.')->group(function () {
                $this->get('/', [StatusesController::class, 'index'])
                     ->name('index');  // admin::backups.statuses.index

                $this->post('backup', [StatusesController::class, 'backup'])
                     ->middleware(['ajax'])
                     ->name('backup'); // admin::backups.statuses.backup

                $this->post('clear', [StatusesController::class, 'clear'])
                     ->middleware(['ajax'])
                     ->name('clear');  // admin::backups.statuses.clear

                $this->get('{index}', [StatusesController::class, 'show'])
                     ->name('show');   // admin::backups.statuses.clear
            });
        });
    }
}
