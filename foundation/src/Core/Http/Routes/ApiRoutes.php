<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Routes;

use Arcanesoft\Foundation\Core\Http\Controllers\Api\EventsController;

/**
 * Class     ApiRoutes
 *
 * @package  Arcanesoft\Foundation\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ApiRoutes extends AbstractRouteRegistrar
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
            $this->prefix('api')->name('api.')->middleware(['ajax'])->group(function () {
                $this->prefix('events')->name('events.')->group(function () {
                    $this->post('/', [EventsController::class, 'handle'])
                         ->name('handle');
                });
            });
        });
    }
}
