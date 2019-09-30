<?php namespace Arcanesoft\Auth\Policies;

use App\Models\User as AuthenticatedUser;
use Arcanesoft\Auth\Models\Role;
use Arcanesoft\Support\Policies\Policy;

/**
 * Class     RolesPolicy
 *
 * @package  Arcanesoft\Auth\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RolesPolicy extends Policy
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the policy's prefix.
     *
     * @return string
     */
    public static function prefix(): string
    {
        return 'admin::auth.roles';
    }

    /**
     * Get the policy metas.
     *
     * @return array
     */
    public static function metas(): array
    {
        return [
            static::meta('index') // admin::auth.roles.index
                  ->name('List all the roles')
                  ->description('Ability to list all the roles'),

            static::meta('show') // admin::auth.roles.show
                  ->name('Show a role')
                  ->description("Ability to show the role's details"),

            static::meta('create') // admin::auth.roles.create
                  ->name('Create a new role')
                  ->description('Ability to create a new role'),

            static::meta('update') // admin::auth.roles.update
                  ->name('Update a role')
                  ->description('Ability to update a role'),

            static::meta('activate') // admin::auth.roles.activate
                  ->name('Activate a role')
                  ->description('Ability to activate a role'),

            static::meta('delete') // admin::auth.roles.delete
                  ->name('Delete a role')
                  ->description('Ability to delete a role'),
        ];
    }

    /* -----------------------------------------------------------------
     |  Policies
     | -----------------------------------------------------------------
     */

    /**
     * Allow to list all the roles.
     *
     * @param  \App\Models\User  $user
     *
     * @return bool|void
     */
    public function index(AuthenticatedUser $user)
    {
        //
    }

    /**
     * Allow to show a role details.
     *
     * @param  \App\Models\User  $user
     *
     * @return bool|void
     */
    public function show(AuthenticatedUser $user)
    {
        //
    }

    /**
     * Allow to create a role.
     *
     * @param  \App\Models\User  $user
     *
     * @return bool|void
     */
    public function create(AuthenticatedUser $user)
    {
        //
    }

    /**
     * Allow to update a role.
     *
     * @param  \App\Models\User                   $user
     * @param  \Arcanesoft\Auth\Models\Role|null  $role
     *
     * @return bool|void
     */
    public function update(AuthenticatedUser $user, Role $role = null)
    {
        //
    }

    /**
     * Activate to update a role.
     *
     * @param  \App\Models\User                   $user
     * @param  \Arcanesoft\Auth\Models\Role|null  $role
     *
     * @return bool|void
     */
    public function activate(AuthenticatedUser $user, Role $role = null)
    {
        if ( ! is_null($role))
            return ! $role->isLocked();
    }

    /**
     * Allow to delete a role.
     *
     * @param  \App\Models\User                   $user
     * @param  \Arcanesoft\Auth\Models\Role|null  $role
     *
     * @return bool|void
     */
    public function delete(AuthenticatedUser $user, Role $role = null)
    {
        if ( ! is_null($role))
            return $role->isDeletable();
    }
}
