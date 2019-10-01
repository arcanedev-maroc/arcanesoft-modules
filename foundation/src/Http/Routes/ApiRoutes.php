<?php

namespace Arcanesoft\Foundation\Http\Routes;

use Arcanesoft\Foundation\Http\Controllers\Api\EventsController;

/**
 * Class     ApiRoutes
 *
 * @package  Arcanesoft\Foundation\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ApiRoutes extends RouteRegistrar
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
            $this->prefix('api')->name('foundation.api.')->middleware(['ajax'])->group(function () {
                $this->prefix('events')->name('events.')->group(function () {
                    $this->post('/', [EventsController::class, 'handle'])
                         ->name('handle');
                });
            });
        });
    }
}
