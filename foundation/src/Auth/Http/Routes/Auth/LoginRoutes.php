<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Routes\Auth;

use Arcanesoft\Foundation\Auth\Http\Controllers\Auth\LoginController;
use Arcanesoft\Foundation\Fortify\LoginRateLimiter;

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
            $this->prefix('auth')->name('auth.')->group(function () {
                $this->mapLoginRoutes();
                $this->mapLogoutRoute();
            });
        });
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map login routes.
     */
    protected function mapLoginRoutes(): void
    {
        $this->prefix('login')->name('login.')->middleware(['guest'])->group(function () {
            // admin::auth.login.show
            $this->get('/', [LoginController::class, 'create'])
                 ->name('show');

            // admin::auth.login.post
            $this->post('/', [LoginController::class, 'store'])
                 ->middleware([LoginRateLimiter::middleware()])
                 ->name('post');
        });
    }

    /**
     * Map logout route.
     */
    protected function mapLogoutRoute(): void
    {
        // admin::auth.logout
        $this->delete('logout', [LoginController::class, 'destroy'])
             ->name('logout');
    }
}
