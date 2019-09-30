<?php namespace Arcanesoft\Foundation\Http\Routes;

use Arcanesoft\Foundation\Http\Controllers\System\{LogViewerController, MaintenanceController, RoutesViewerController};
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
     *
     * @return void
     */
    public function map(): void
    {
        $this->adminGroup(function () {
            $this->prefix('system')->name('foundation.system.')->group(function () {
                $this->get('/', [SystemController::class, 'index'])
                     ->name('index'); // admin::foundation.system.index

                $this->mapMaintenanceRoutes();
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
     *
     * @return void
     */
    private function mapMaintenanceRoutes(): void
    {
        $this->prefix('maintenance')->name('maintenance.')->group(function () {
            $this->get('/', [MaintenanceController::class, 'index'])
                 ->name('index'); // admin::foundation.system.maintenance.index

            $this->post('start', [MaintenanceController::class, 'start'])
                 ->name('start'); // admin::foundation.system.maintenance.start

            $this->post('stop', [MaintenanceController::class, 'stop'])
                 ->name('stop'); // admin::foundation.system.maintenance.stop
        });
    }

    /**
     * Map LogViewer routes.
     *
     * @return void
     */
    protected function mapLogViewerRoutes(): void
    {
        $this->prefix('log-viewer')->name('log-viewer.')->group(function () {
            $this->get('/', [LogViewerController::class, 'index'])
                 ->name('index'); // admin::foundation.system.log-viewer.index

            $this->prefix('logs')->name('logs.')->group(function () {
                $this->get('/', [LogViewerController::class, 'logs'])
                     ->name('index'); // admin::foundation.system.log-viewer.logs.index

                $this->prefix('{log_file_date}')->group(function () {
                    $this->get('/', [LogViewerController::class, 'showLog'])
                         ->name('show'); // admin::foundation.system.log-viewer.logs.show

                    $this->get('download', [LogViewerController::class, 'download'])
                         ->name('download'); // admin::foundation.system.log-viewer.logs.download

                    $this->delete('delete', [LogViewerController::class, 'delete'])
                         ->middleware(['ajax'])
                         ->name('delete'); // admin::foundation.system.log-viewer.logs.delete

                    $this->prefix('{log_level}')->group(function () {
                        $this->get('/', [LogViewerController::class, 'filter'])
                             ->name('filter'); // admin::foundation.system.log-viewer.logs.filter

                        $this->get('search', [LogViewerController::class, 'search'])
                             ->name('search'); // admin::foundation.system.log-viewer.logs.search
                    });
                });
            });
        });
    }

    /**
     * Map RoutesViewer routes.
     *
     * @return void
     */
    private function mapRoutesViewerRoutes(): void
    {
        $this->prefix('routes-viewer')->name('routes-viewer.')->group(function () {
            $this->get('/', [RoutesViewerController::class, 'index'])
                 ->name('index'); // admin::foundation.system.routes-viewer.index
        });
    }
}
