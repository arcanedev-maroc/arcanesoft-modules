<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Routes\Auth;

use Arcanesoft\Foundation\Auth\Http\Controllers\Auth\ConfirmPasswordController;

/**
 * Class     ConfirmPasswordRoutes
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Routes\Auth
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ConfirmPasswordRoutes extends AdminRouteRegistrar
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
            $this->prefix('auth/password/confirm')
                 ->name('auth.password.confirm.')
                 ->middleware(['auth:admin'])
                 ->group(function () {
                     // auth::admin.password.confirm.create
                     $this->get('/', [ConfirmPasswordController::class, 'showConfirmForm'])
                          ->name('create');

                     // auth::admin.password.confirm.store
                     $this->post('/', [ConfirmPasswordController::class, 'confirm'])
                          ->name('store');
                 });
        });
    }

}
