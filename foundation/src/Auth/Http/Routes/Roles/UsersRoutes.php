<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Routes\Roles;

use Arcanesoft\Foundation\Auth\Http\Controllers\Roles\UsersController;
use Arcanesoft\Foundation\Auth\Http\Routes\{RolesRoutes, AbstractRouteRegistrar};
use Arcanesoft\Foundation\Auth\Repositories\RolesRepository;
use Illuminate\Routing\Route;

/**
 * Class     UsersRoutes
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Routes\Roles
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UsersRoutes extends AbstractRouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const USER_WILDCARD = 'admin_auth_role_user';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map the routes.
     */
    public function map(): void
    {
        $this->prefix('users')->name('users.')->group(function () {
            $this->prefix('{'.self::USER_WILDCARD.'}')->group(function () {
                // admin::auth.roles.users.detach
                $this->delete('detach', [UsersController::class, 'detach'])
                     ->name('detach');
            });
        });
    }

    /**
     * Register the route bindings.
     *
     * @param  \Arcanesoft\Foundation\Auth\Repositories\RolesRepository  $repo
     */
    public function bindings(RolesRepository $repo): void
    {
        $this->bind(self::USER_WILDCARD, function (string $uuid, Route $route) use ($repo) {
            /** @var  \Arcanesoft\Foundation\Auth\Models\Role  $role */
            $role = $route->parameter(RolesRoutes::ROLE_WILDCARD);

            return $repo->firstUserWithUuidOrFail($role, $uuid);
        });
    }
}