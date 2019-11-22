<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Routes;

use Arcanesoft\Foundation\Auth\Http\Controllers\Auth\LoginController;
use Arcanesoft\Foundation\Support\Http\RouteRegistrar;

/**
 * Class     AuthRoutes
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AuthRoutes extends RouteRegistrar
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
        $this->prefix('admin/auth')->name('admin-auth::')->group(function () {
            $this->mapAuthenticationRoutes();
            //$this->mapPasswordResetRoutes();
            //$this->mapEmailVerificationRoutes();
            //$this->mapConfirmPasswordRoutes();
        });
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map the admin authentication route.
     */
    private function mapAuthenticationRoutes(): void
    {
        $this->prefix('login')->name('login.')->middleware(['web', 'guest'])->group(function () {
            $this->get('/', [LoginController::class, 'showLoginForm'])
                ->name('show'); // auth::login.show

            $this->post('/', [LoginController::class, 'login'])
                ->name('post'); // auth::login.post
        });
    }
}