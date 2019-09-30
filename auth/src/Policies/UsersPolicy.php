<?php namespace Arcanesoft\Auth\Policies;

use App\Models\User as AuthenticatedUser;
use Arcanesoft\Auth\Models\User;
use Arcanesoft\Support\Policies\Policy;

/**
 * Class     UsersPolicy
 *
 * @package  Arcanesoft\Auth\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * TODO: Check the abilities
 */
class UsersPolicy extends Policy
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
        return 'admin::auth.users';
    }

    /**
     * Get the policy metas.
     *
     * @return array
     */
    public static function metas(): array
    {
        return [
            static::meta('index') // admin::auth.users.index
                  ->name('List all the users')
                  ->description('Ability to list all the users'),

            static::meta('metrics') // admin::auth.users.metrics
                  ->name("List all the users' metrics")
                  ->description("Ability to list all the users' metrics"),

            static::meta('show') // admin::auth.users.show
                  ->name('Show a user')
                  ->description("Ability to show the user's details"),

            static::meta('create') // admin::auth.users.create
                  ->name('Create a new user')
                  ->description('Ability to create a new user'),

            static::meta('update') // admin::auth.users.update
                  ->name('Update a user')
                  ->description('Ability to update a user'),

            static::meta('activate') // admin::auth.users.activate
                  ->name('Activate/Deactivate a user')
                  ->description('Ability to activate/deactivate a user'),

            static::meta('delete') // admin::auth.users.delete
                  ->name('Delete a user')
                  ->description('Ability to delete a user'),

            static::meta('force-delete', 'forceDelete') // admin::auth.users.force-delete
                  ->name('Force Delete a user')
                  ->description('Ability to force delete a user'),

            static::meta('restore') // admin::auth.users.restore
                  ->name('Restore a user')
                  ->description('Ability to restore a user'),

            static::meta('impersonate') // admin::auth.users.impersonate
                  ->name('Impersonate a user')
                  ->description('Ability to impersonate a user'),
        ];
    }

    /* -----------------------------------------------------------------
     |  Policies
     | -----------------------------------------------------------------
     */

    /**
     * Allow to list all the users.
     *
     * @param  \App\Models\User|mixed  $user
     *
     * @return bool|void
     */
    public function index(AuthenticatedUser $user)
    {
        //
    }

    /**
     * Allow to list all the users' metrics.
     *
     * @param  \App\Models\User|mixed  $user
     *
     * @return bool|void
     */
    public function metrics(AuthenticatedUser $user)
    {
        //
    }

    /**
     * Allow to show a user details.
     *
     * @param  \App\Models\User|mixed  $user
     *
     * @return bool|void
     */
    public function show(AuthenticatedUser $user)
    {
        //
    }

    /**
     * Allow to create a user.
     *
     * @param  \App\Models\User|mixed  $user
     *
     * @return bool|void
     */
    public function create(AuthenticatedUser $user)
    {
        //
    }

    /**
     * Allow to update a user.
     *
     * @param  \App\Models\User                   $user
     * @param  \Arcanesoft\Auth\Models\User|null  $model
     *
     * @return bool|void
     */
    public function update(AuthenticatedUser $user, User $model = null)
    {
        //
    }

    /**
     * Allow to update a user.
     *
     * @param  \App\Models\User                   $user
     * @param  \Arcanesoft\Auth\Models\User|null  $model
     *
     * @return bool|void
     */
    public function activate(AuthenticatedUser $user, User $model = null)
    {
        if ($user->is($model))
            return false;

        if ( ! is_null($model) && $model->isSuperAdmin())
            return false;
    }

    /**
     * Allow to delete a user.
     *
     * @param  \App\Models\User                   $user
     * @param  \Arcanesoft\Auth\Models\User|null  $model
     *
     * @return bool|void
     */
    public function delete(AuthenticatedUser $user, User $model = null)
    {
        if ($user->is($model))
            return false;

        if ( ! is_null($model))
            return $model->isDeletable();
    }

    /**
     * Allow to force delete a user.
     *
     * @param  \App\Models\User                   $user
     * @param  \Arcanesoft\Auth\Models\User|null  $model
     *
     * @return bool|void
     */
    public function forceDelete(AuthenticatedUser $user, User $model = null)
    {
        if ( ! is_null($model))
            return $model->isDeletable();
    }

    /**
     * Allow to restore a user.
     *
     * @param  \App\Models\User                   $user
     * @param  \Arcanesoft\Auth\Models\User|null  $model
     *
     * @return bool|void
     */
    public function restore(AuthenticatedUser $user, User $model = null)
    {
        if ( ! is_null($model))
            return $model->trashed();
    }

    /**
     * Allow to impersonate a user.
     *
     * @param  \App\Models\User                   $user
     * @param  \Arcanesoft\Auth\Models\User|null  $model
     *
     * @return bool|void
     */
    public function impersonate(AuthenticatedUser $user, User $model = null)
    {
        if ($model->isAdmin())
            return false;

        return $user->isNot($model);
    }
}
