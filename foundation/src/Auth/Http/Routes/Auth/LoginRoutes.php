<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Routes\Auth;

use Arcanesoft\Foundation\Auth\Http\Controllers\Auth\LoginController;

/**
 * Class     LoginRoutes
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Routes\Auth
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LoginRoutes extends AdminRouteRegistrar
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
            $this->prefix('auth/login')
                 ->name('auth.login.')
                 ->middleware(['guest'])
                 ->group(function () {
                     // admin::auth.login.show
                     $this->get('/', [LoginController::class, 'showLoginForm'])
                          ->name('show');

                     // admin::auth.login.post
                     $this->post('/', [LoginController::class, 'login'])
                          ->name('post');
                 });
        });
    }
}
