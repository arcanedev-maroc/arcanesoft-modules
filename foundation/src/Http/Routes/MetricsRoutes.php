<?php namespace Arcanesoft\Foundation\Http\Routes;

use Arcanesoft\Foundation\Http\Controllers\MetricsController;

/**
 * Class     MetricsRoutes
 *
 * @package  Arcanesoft\Foundation\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MetricsRoutes extends RouteRegistrar
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
            $this->prefix('metrics')->name('foundation.metrics.')->group(function () {
                $this->get('process', [MetricsController::class, 'process'])
                     ->middleware(['ajax'])
                     ->name('process'); // api-admin::foundation.metrics.process
            });
        });
    }
}
