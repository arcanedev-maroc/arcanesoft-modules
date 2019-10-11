<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Controllers\Roles;

use Arcanesoft\Foundation\Auth\Http\Controllers\Controller;
use Arcanesoft\Foundation\Auth\Models\{Role, User};
use Arcanesoft\Foundation\Auth\Policies\RolesPolicy;
use Arcanesoft\Foundation\Auth\Repositories\RolesRepository;
use Illuminate\Http\JsonResponse;

/**
 * Class     UsersController
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Controllers\Roles
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UsersController extends Controller
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * @param  \Arcanesoft\Foundation\Auth\Models\Role                   $role
     * @param  \Arcanesoft\Foundation\Auth\Models\User                   $user
     * @param  \Arcanesoft\Foundation\Auth\Repositories\RolesRepository  $repo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function detach(Role $role, User $user, RolesRepository $repo): JsonResponse
    {
        $this->authorize(RolesPolicy::ability('users.detach'), [$role, $user]);

        $repo->detachUser($role, $user);

        // TODO: Add notification

        return static::jsonResponseSuccess();
    }
}