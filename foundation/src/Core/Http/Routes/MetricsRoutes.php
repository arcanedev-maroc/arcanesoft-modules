<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Routes;

use Arcanesoft\Foundation\Core\Http\Controllers\MetricsController;

/**
 * Class     MetricsRoutes
 *
 * @package  Arcanesoft\Foundation\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MetricsRoutes extends AbstractRouteRegistrar
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
            $this->prefix('metrics')->name('foundation.metrics.')->group(function () {
                // api-admin::foundation.metrics.process
                $this->get('process', [MetricsController::class, 'process'])
                     ->middleware(['ajax'])
                     ->name('process');
            });
        });
    }
}
