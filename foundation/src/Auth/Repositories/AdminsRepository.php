<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Repositories;

use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Auth\Events\Admins\{
    ActivatedAdmin, ActivatingAdmin, DeactivatedAdmin, DeactivatingAdmin, SyncedRolesToAdmin, SyncingRolesToAdmin
};
use Arcanesoft\Foundation\Auth\Models\Role;
use Arcanesoft\Foundation\Auth\Models\Admin;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Class     AdminsRepository
 *
 * @package  Arcanesoft\Foundation\Auth\Repositories
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AdminsRepository extends AbstractRepository
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the model FQN class.
     *
     * @return string
     */
    public static function modelClass(): string
    {
        return Auth::model('admin', Admin::class);
    }

    /* -----------------------------------------------------------------
     |  Queries
     | -----------------------------------------------------------------
     */

    /**
     * Add a uuid where clause to the query.
     *
     * @param  string  $value
     *
     * @return \Illuminate\Database\Eloquent\Builder|mixed
     */
    public function whereUuid(string $value)
    {
        return $this->where('uuid', '=', $value);
    }

    /**
     * Scope only the trashed records.
     *
     * @param  bool  $condition
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Admin|\Illuminate\Database\Eloquent\Builder
     */
    public function onlyTrashed(bool $condition = true)
    {
        return $this->when($condition, function (Builder $q) {
            return $q->onlyTrashed();
        });
    }

    /* -----------------------------------------------------------------
     |  CRUD Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the first user with the given uuid, or fails if not found.
     *
     * @param  string  $uuid
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Admin|mixed
     */
    public function firstWhereUuidOrFail(string $uuid): Admin
    {
        return $this->where('uuid', '=', $uuid)
            ->withTrashed() // Get also trashed records
            ->firstOrFail();
    }

    /**
     * Create a new user.
     *
     * @param  array  $attributes
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Admin
     */
    public function createAdmin(array $attributes): Admin
    {
        $attributes['password'] = $attributes['password'] ?? Str::random(8);

        return tap($this->model()->fill($attributes), function (Admin $admin) use ($attributes) {
            $admin->forceFill([
                'activated_at' => $attributes['activated_at'] ?? now(), // TODO: Add a setting to change this
            ]);

            $admin->save();
        });
    }

    /**
     * Update the given user (+ synced roles).
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin  $admin
     * @param  array                                     $attributes
     *
     * @return bool
     */
    public function updateAdmin(Admin $admin, array $attributes): bool
    {
        $attributes = array_filter($attributes);

        return tap($admin->update($attributes), function () use ($admin, $attributes) {
            $this->syncRolesByUuids($admin, $attributes['roles'] ?? []);
        });
    }

    /**
     * Activate/Deactivate a user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin  $admin
     *
     * @return bool
     */
    public function toggleActive(Admin $admin): bool
    {
        return $admin->isActive()
            ? $this->deactivate($admin)
            : $this->activate($admin);
    }

    /**
     * Activate the given user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin  $admin
     *
     * @return bool
     */
    public function activate(Admin $admin)
    {
        if ($admin->isActive())
            return false;

        event(new ActivatingAdmin($admin));
        $result = $admin->forceFill(['activated_at' => $admin->freshTimestamp()])->save();
        event(new ActivatedAdmin($admin));

        return $result;
    }

    /**
     * Deactivate the given user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin  $admin
     *
     * @return bool
     */
    public function deactivate(Admin $admin): bool
    {
        if ( ! $admin->isActive())
            return false;

        event(new DeactivatingAdmin($admin));
        $result = $admin->forceFill(['activated_at' => null])->save();
        event(new DeactivatedAdmin($admin));

        return $result;
    }

    /**
     * Delete or Force delete a user if trashed.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin  $admin
     *
     * @return bool|null
     */
    public function deleteAdmin(Admin $admin)
    {
        return $admin->trashed() ? $admin->forceDelete() : $admin->delete();
    }

    /**
     * Restore a user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin  $admin
     *
     * @return bool|null
     */
    public function restoreAdmin(Admin $admin)
    {
        return $admin->restore();
    }

    /**
     * Sync roles by keys.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin|mixed  $admin
     * @param  array                                           $keys
     *
     * @return array
     */
    public function syncRolesByKeys(Admin $admin, array $keys): array
    {
        return $this->syncRoles(
            $admin, $this->getRolesRepository()->getByKeys($keys)
        );
    }

    /**
     * Sync roles by uuids.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin  $admin
     * @param  array                                     $uuids
     *
     * @return array
     */
    public function syncRolesByUuids(Admin $admin, array $uuids): array
    {
        return $this->syncRoles(
            $admin, $this->getRolesRepository()->getByUuids($uuids)
        );
    }

    /**
     * Sync roles with the user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin  $admin
     * @param  \Illuminate\Support\Collection            $roles
     *
     * @return array
     */
    public function syncRoles(Admin $admin, Collection $roles): array
    {
        if (empty($roles))
            return [];

        event(new SyncingRolesToAdmin($admin, $roles));
        $synced = $admin->roles()->sync($roles->pluck('id'));
        event(new SyncedRolesToAdmin($admin, $roles, $synced));

        return $synced;
    }

    /* -----------------------------------------------------------------
     |  Count Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the active users count.
     *
     * @return int
     */
    public function activeCount(): int
    {
        return $this->activated()->count();
    }

    /**
     * Get the verified users count.
     *
     * @return int
     */
    public function verifiedCount(): int
    {
        return $this->verifiedEmail()->count();
    }

    /**
     * Get the trashed users count.
     *
     * @return int
     */
    public function trashedCount(): int
    {
        return $this->onlyTrashed()->count();
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the roles repository.
     *
     * @return \Arcanesoft\Foundation\Auth\Repositories\RolesRepository|mixed
     */
    protected function getRolesRepository(): RolesRepository
    {
        return static::getRepository(RolesRepository::class);
    }
}