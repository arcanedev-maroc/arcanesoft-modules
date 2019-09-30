<?php namespace Arcanesoft\Foundation\Http\Routes;

use Arcanesoft\Foundation\Http\Controllers\ProfileController;

/**
 * Class     ProfileRoutes
 *
 * @package  Arcanesoft\Foundation\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ProfileRoutes extends RouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map the routes.
     *
     * @return void
     */
    public function map(): void
    {
        $this->adminGroup(function () {
            $this->prefix('profile')->name('foundation.profile.')->group(function () {
                $this->get('/', [ProfileController::class, 'index'])
                     ->name('index'); // admin::foundation.profile.index

                // Account
                $this->prefix('account')->name('account.')->group(function () {
                    $this->put('update', [ProfileController::class, 'updateAccount'])
                         ->name('update'); // admin::foundation.profile.account.update
                });

                // Password
                $this->prefix('password')->name('password.')->group(function () {
                    $this->put('update', [ProfileController::class, 'updatePassword'])
                         ->name('update'); // admin::foundation.profile.password.update
                });
            });
        });
    }
}
