<?php

namespace Arcanesoft\Auth\Policies;

use App\Models\User as AuthenticatedUser;
use Arcanesoft\Auth\Models\Role;
use Arcanesoft\Foundation\Core\Auth\Policy;

/**
 * Class     RolesPolicy
 *
 * @package  Arcanesoft\Auth\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RolesPolicy extends Policy
{
    /* -----------------------------------------------------------------
     |  Getters
     | -----------------------------------------------------------------
     */

    /**
     * Get the ability's prefix.
     *
     * @return string
     */
    protected static function prefix(): string
    {
        return 'admin::auth.roles.';
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the policy's abilities.
     *
     * @return \Arcanedev\LaravelPolicies\Ability[]|iterable
     */
    public function abilities(): iterable
    {
        return [

            // admin::auth.roles.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'List all the roles',
                'description' => 'Ability to list all the roles',
            ]),

            // admin::auth.roles.show
            $this->makeAbility('show')->setMetas([
                'name'        => 'Show a role',
                'description' => "Ability to show the role's details",
            ]),

            // admin::auth.roles.create
            $this->makeAbility('create')->setMetas([
                'name'        => 'Create a new role',
                'description' => 'Ability to create a new role',
            ]),

            // admin::auth.roles.update
            $this->makeAbility('update')->setMetas([
                'name'        => 'Update a role',
                'description' => 'Ability to update a role',
            ]),

            // admin::auth.roles.activate
            $this->makeAbility('activate')->setMetas([
                'name'        => 'Activate a role',
                'description' => 'Ability to activate a role',
            ]),

            // admin::auth.roles.delete
            $this->makeAbility('delete')->setMetas([
                'name'        => 'Delete a role',
                'description' => 'Ability to delete a role',
            ]),
        ];
    }

    /* -----------------------------------------------------------------
     |  Abilities
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
    public function update(AuthenticatedUser $user, ?Role $role)
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
    public function activate(AuthenticatedUser $user, ?Role $role)
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
    public function delete(AuthenticatedUser $user, ?Role $role)
    {
        if ( ! is_null($role))
            return $role->isDeletable();
    }
}
