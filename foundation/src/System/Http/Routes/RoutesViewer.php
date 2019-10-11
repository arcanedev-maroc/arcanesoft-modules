<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Http\Routes;

use Arcanesoft\Foundation\System\Http\Controllers\RoutesViewerController;

/**
 * Class     RoutesViewer
 *
 * @package  Arcanesoft\Foundation\System\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RoutesViewer extends AbstractRouteRegistrar
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
            $this->prefix('routes-viewer')->name('routes-viewer.')->group(function () {
                // admin::system.routes-viewer.index
                $this->get('/', [RoutesViewerController::class, 'index'])
                     ->name('index');
            });
        });
    }
}