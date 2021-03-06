<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Routes;

use Arcanesoft\Foundation\Auth\Http\Controllers\Datatables\PasswordResetsController as PasswordResetsDataTablesController;
use Arcanesoft\Foundation\Auth\Http\Controllers\PasswordResetsController;

/**
 * Class     PasswordResetsRoutes
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PasswordResetsRoutes extends AbstractRouteRegistrar
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
            $this->name('password-resets.')->prefix('password-resets')->group(function () {
                // admin::authorization.password-resets.index
                $this->get('/', [PasswordResetsController::class, 'index'])
                     ->name('index');

                $this->dataTableGroup(function () {
                    // admin::auth.password-resets.datatables.index
                    $this->get('/', [PasswordResetsDataTablesController::class, 'index'])
                        ->name('index');
                });

                // admin::authorization.password-resets.metrics
                $this->get('metrics', [PasswordResetsController::class, 'metrics'])
                     ->name('metrics');
            });
        });
    }
}
