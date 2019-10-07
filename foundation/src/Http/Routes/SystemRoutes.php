<?php

namespace Arcanesoft\Foundation\Http\Routes;

use Arcanesoft\Foundation\Http\Controllers\System\{
    AbilitiesController,
    LogViewerController,
    MaintenanceController,
    RoutesViewerController};
use Arcanesoft\Foundation\Http\Controllers\SystemController;

/**
 * Class     SystemRoutes
 *
 * @package  Arcanesoft\Foundation\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SystemRoutes extends RouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map the routes.
     */
    public function map(): void
    {
        $this->adminGroup(function () {
            $this->prefix('system')->name('foundation.system.')->group(function () {
                // admin::foundation.system.index
                $this->get('/', [SystemController::class, 'index'])
                     ->name('index');

                $this->mapMaintenanceRoutes();
                $this->mapAbilitiesRoutes();
                $this->mapLogViewerRoutes();
                $this->mapRoutesViewerRoutes();
            });
        });
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map Maintenance routes.
     */
    private function mapMaintenanceRoutes(): void
    {
        $this->prefix('maintenance')->name('maintenance.')->group(function () {
            // admin::foundation.system.maintenance.index
            $this->get('/', [MaintenanceController::class, 'index'])
                 ->name('index');

            // admin::foundation.system.maintenance.start
            $this->post('start', [MaintenanceController::class, 'start'])
                 ->name('start');

            // admin::foundation.system.maintenance.stop
            $this->post('stop', [MaintenanceController::class, 'stop'])
                 ->name('stop');
        });
    }

    /**
     * Map abilities routes.
     */
    private function mapAbilitiesRoutes(): void
    {
        $this->prefix('abilities')->name('abilities.')->group(function () {
            // admin::foundation.system.abilities.index
            $this->get('/', [AbilitiesController::class, 'index'])
                ->name('index');
        });
    }

    /**
     * Map LogViewer routes.
     */
    protected function mapLogViewerRoutes(): void
    {
        $this->prefix('log-viewer')->name('log-viewer.')->group(function () {
            // admin::foundation.system.log-viewer.index
            $this->get('/', [LogViewerController::class, 'index'])
                 ->name('index');

            $this->prefix('logs')->name('logs.')->group(function () {
                // admin::foundation.system.log-viewer.logs.index
                $this->get('/', [LogViewerController::class, 'logs'])
                     ->name('index');

                $this->prefix('{log_file_date}')->group(function () {
                    // admin::foundation.system.log-viewer.logs.show
                    $this->get('/', [LogViewerController::class, 'showLog'])
                         ->name('show');

                    // admin::foundation.system.log-viewer.logs.download
                    $this->get('download', [LogViewerController::class, 'download'])
                         ->name('download');

                    // admin::foundation.system.log-viewer.logs.delete
                    $this->delete('delete', [LogViewerController::class, 'delete'])
                         ->middleware(['ajax'])
                         ->name('delete');

                    $this->prefix('{log_level}')->group(function () {
                        // admin::foundation.system.log-viewer.logs.filter
                        $this->get('/', [LogViewerController::class, 'filter'])
                             ->name('filter');

                        // admin::foundation.system.log-viewer.logs.search
                        $this->get('search', [LogViewerController::class, 'search'])
                             ->name('search');
                    });
                });
            });
        });
    }

    /**
     * Map RoutesViewer routes.
     */
    private function mapRoutesViewerRoutes(): void
    {
        $this->prefix('routes-viewer')->name('routes-viewer.')->group(function () {
            // admin::foundation.system.routes-viewer.index
            $this->get('/', [RoutesViewerController::class, 'index'])
                 ->name('index');
        });
    }
}
