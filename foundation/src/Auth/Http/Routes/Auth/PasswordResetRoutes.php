<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Routes\Auth;

use Arcanesoft\Foundation\Auth\Http\Controllers\Auth\{ForgotPasswordController,
    PasswordResetLinkController,
    ResetPasswordController};

/**
 * Class     PasswordResetRoutes
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Routes\Auth
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PasswordResetRoutes extends AdminRouteRegistrar
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
            $this->prefix('auth/password')
                 ->name('auth.password.')
                 ->middleware(['guest'])
                 ->group(function () {
                     // admin::auth.password.request
                     $this->get('forgotten', [PasswordResetLinkController::class, 'create'])
                          ->name('request');

                     // admin::auth.password.email
                     $this->post('forgotten', [PasswordResetLinkController::class, 'store'])
                          ->name('email');

                     // admin::auth.password.reset
                     $this->get('reset/{token}', [ResetPasswordController::class, 'edit'])
                         ->name('reset');

                     // admin::auth.password.update
                     $this->post('reset', [ResetPasswordController::class, 'update'])
                          ->name('update');
            });
        });
    }
}
