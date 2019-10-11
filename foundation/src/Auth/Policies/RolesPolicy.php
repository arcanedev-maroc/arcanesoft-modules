<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Policies;

use Arcanesoft\Foundation\Auth\Models\{
    Permission, Role, User, User as AuthenticatedUser
};

/**
 * Class     RolesPolicy
 *
 * @package  Arcanesoft\Foundation\Auth\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RolesPolicy extends AbstractPolicy
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
        $this->setMetas([
            'category' => 'Roles',
        ]);

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

            // admin::auth.roles.permissions.detach
            $this->makeAbility('users.detach', 'detachUser')->setMetas([
                'name'        => 'Detach a user',
                'description' => 'Ability to detach the related user from role',
            ]),

            // admin::auth.roles.permissions.detach
            $this->makeAbility('permissions.detach', 'detachPermission')->setMetas([
                'name'        => 'Detach a permission',
                'description' => 'Ability to detach the related permission from role',
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
     * @param  \Arcanesoft\Foundation\Auth\Models\User|mixed  $user
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function index(AuthenticatedUser $user)
    {
        //
    }

    /**
     * Allow to show a role details.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User|mixed  $user
     * @param  \Arcanesoft\Foundation\Auth\Models\Role|null   $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function show(AuthenticatedUser $user, Role $model = null)
    {
        if ($model && $model->key === Role::ADMINISTRATOR && ! $user->isSuperAdmin())
            return false;
    }

    /**
     * Allow to create a role.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User|mixed  $user
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function create(AuthenticatedUser $user)
    {
        //
    }

    /**
     * Allow to update a role.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User|mixed  $user
     * @param  \Arcanesoft\Foundation\Auth\Models\Role|null   $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function update(AuthenticatedUser $user, Role $model = null)
    {
        //
    }

    /**
     * Activate to update a role.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User|mixed  $user
     * @param  \Arcanesoft\Foundation\Auth\Models\Role|null   $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function activate(AuthenticatedUser $user, Role $model = null)
    {
        if (static::isRoleLocked($model))
            return false;
    }

    /**
     * Allow to delete a role.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User|mixed  $user
     * @param  \Arcanesoft\Foundation\Auth\Models\Role|null   $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function delete(AuthenticatedUser $user, Role $model = null)
    {
        if ( ! is_null($model))
            return $model->isDeletable();
    }

    /**
     * Allow to detach a user from a role.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User|mixed  $user
     * @param \Arcanesoft\Foundation\Auth\Models\Role|null    $model
     * @param \Arcanesoft\Foundation\Auth\Models\User|null    $related
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function detachUser(AuthenticatedUser $user, Role $model = null, User $related = null)
    {
        if (static::isRoleLocked($model))
            return false;

        if ( ! $user->isAdmin() && $related->isAdmin())
            return false;
    }

    /**
     * Allow to detach a permission from a role.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User|mixed       $user
     * @param  \Arcanesoft\Foundation\Auth\Models\Role|null        $model
     * @param  \Arcanesoft\Foundation\Auth\Models\Permission|null  $related
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function detachPermission(AuthenticatedUser $user, Role $model = null, Permission $related = null)
    {
        if (static::isRoleLocked($model))
            return false;
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if the role is locked.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role|null  $model
     *
     * @return bool
     */
    protected static function isRoleLocked(Role $model = null): bool
    {
        return ! is_null($model) && $model->isLocked();
    }
}
