<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Policies;

use Arcanesoft\Foundation\Auth\Models\Admin;
use Arcanesoft\Foundation\Auth\Models\Admin as AuthenticatedAdmin;

/**
 * Class     AdminsPolicy
 *
 * @package  Arcanesoft\Foundation\Auth\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AdminsPolicy extends AbstractPolicy
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
        return 'admin::auth.admins.';
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
            'category' => 'Admins',
        ]);

        return [

            // admin::auth.admins.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'List all the admins',
                'description' => 'Ability to list all the admins'
            ]),

            // admin::auth.admins.metrics
            $this->makeAbility('metrics')->setMetas([
                'name'        => "List all the admins' metrics",
                'description' => "Ability to list all the admins' metrics",
            ]),

            // admin::auth.admins.show
            $this->makeAbility('show')->setMetas([
                'name'        => 'Show an admin',
                'description' => "Ability to show the admin's details",
            ]),

            // admin::auth.admins.create
            $this->makeAbility('create')->setMetas([
                'name'        => 'Create a new admin',
                'description' => 'Ability to create a new admin',
            ]),

            // admin::auth.admins.update
            $this->makeAbility('update')->setMetas([
                'name'        => 'Update a admin',
                'description' => 'Ability to update a admin',
            ]),

            // admin::auth.admins.activate
            $this->makeAbility('activate')->setMetas([
                'name'        => 'Activate/Deactivate a admin',
                'description' => 'Ability to activate/deactivate a admin',
            ]),

            // admin::auth.admins.delete
            $this->makeAbility('delete')->setMetas([
                'name'        => 'Delete a admin',
                'description' => 'Ability to delete a admin',
            ]),

            // admin::auth.admins.force-delete
            $this->makeAbility('force-delete')->setMetas([
                'name'        => 'Force Delete a admin',
                'description' => 'Ability to force delete a admin',
            ]),

            // admin::auth.admins.restore
            $this->makeAbility('restore')->setMetas([
                'name'        => 'Restore a admin',
                'description' => 'Ability to restore a admin',
            ]),

            // admin::auth.admins.impersonate
            $this->makeAbility('impersonate')->setMetas([
                'name'        => 'Impersonate a admin',
                'description' => 'Ability to impersonate a admin',
            ]),
        ];
    }

    /* -----------------------------------------------------------------
     |  Abilities
     | -----------------------------------------------------------------
     */

    /**
     * Allow to list all the admins.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin|mixed  $admin
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function index(AuthenticatedAdmin $admin)
    {
        //
    }

    /**
     * Allow to list all the admins' metrics.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin|mixed  $admin
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function metrics(AuthenticatedAdmin $admin)
    {
        //
    }

    /**
     * Allow to show a admin details.
     *
     * @param \Arcanesoft\Foundation\Auth\Models\Admin|mixed  $admin
     * @param \Arcanesoft\Foundation\Auth\Models\Admin|null   $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function show(AuthenticatedAdmin $admin, Admin $model = null)
    {
        if ($model && $model->isSuperAdmin() && ! $admin->isSuperAdmin())
            return false;
    }

    /**
     * Allow to create a admin.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin|mixed  $admin
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function create(AuthenticatedAdmin $admin)
    {
        //
    }

    /**
     * Allow to update a admin.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin|mixed  $admin
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin|null   $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function update(AuthenticatedAdmin $admin, Admin $model = null)
    {
        //
    }

    /**
     * Allow to update a admin.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin|mixed  $admin
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin|null   $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function activate(AuthenticatedAdmin $admin, Admin $model = null)
    {
        if ($admin->is($model))
            return false;

        if ( ! is_null($model) && $model->isSuperAdmin())
            return false;
    }

    /**
     * Allow to delete a admin.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin|mixed  $admin
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin|null   $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function delete(AuthenticatedAdmin $admin, Admin $model = null)
    {
        if ($admin->is($model))
            return false;

        if ( ! is_null($model))
            return $model->isDeletable();
    }

    /**
     * Allow to force delete a admin.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin|mixed  $admin
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin|null   $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function forceDelete(AuthenticatedAdmin $admin, Admin $model = null)
    {
        if ( ! is_null($model))
            return $model->isDeletable();
    }

    /**
     * Allow to restore a admin.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin|mixed  $admin
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin|null   $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function restore(AuthenticatedAdmin $admin, Admin $model = null)
    {
        if ( ! is_null($model))
            return $model->trashed();
    }

    /**
     * Allow to impersonate a admin.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin|mixed  $admin
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin|null   $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function impersonate(AuthenticatedAdmin $admin, Admin $model)
    {
        return $admin->isNot($model);
    }
}