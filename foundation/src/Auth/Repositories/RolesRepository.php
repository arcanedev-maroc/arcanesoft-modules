<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Repositories;

use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Auth\Models\{
    Admin,
    Role,
    Permission,
    User};
use Arcanesoft\Foundation\Auth\Events\Roles\{
    Users\DetachedAllUsers, Permissions\DetachedPermission, Users\DetachedUser, Permissions\DetachingAllPermissions,
    Permissions\DetachedAllPermissions, Users\DetachingAllUsers, Permissions\DetachingPermission, Users\DetachingUser,
    Permissions\SyncedPermissions, Permissions\SyncingPermissions
};

/**
 * Class     RolesRepository
 *
 * @package  Arcanesoft\Foundation\Auth\Repositories
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @mixin  \Arcanesoft\Foundation\Auth\Models\Role
 */
class RolesRepository extends AbstractRepository
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
        return Auth::model('role', Role::class);
    }

    /* -----------------------------------------------------------------
     |  CRUD Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the admin role.
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Role|mixed
     */
    public function getAdminRole(): Role
    {
        return $this->admin()->first();
    }

    /**
     * Get first role with the given key, or fails if not found.
     *
     * @param  string  $key
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Role|mixed
     */
    public function firstWithKeyOrFail(string $key): Role
    {
        return $this->where('key', '=', $key)->firstOrFail();
    }

    /**
     * Get first role by the given uuid, or fails if not found.
     *
     * @param  string  $uuid
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Role|mixed
     */
    public function firstWithUuidOrFail(string $uuid): Role
    {
        return $this->where('uuid', '=', $uuid)->firstOrFail();
    }

    /**
     * Get first related user by the given uuid, or fails if not found.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role  $role
     * @param  string                                   $uuid
     *
     * @return \Arcanesoft\Foundation\Auth\Models\User|mixed
     */
    public function firstUserWithUuidOrFail(Role $role, string $uuid): User
    {
        return $role->users()
                    ->where('uuid', '=', $uuid)
                    ->withTrashed() // Get also trashed records
                    ->firstOrFail();
    }

    /**
     * Get first related permission by the given uuid, or fails if not found.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role  $role
     * @param  string                                   $uuid
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Permission|mixed
     */
    public function firstPermissionWithUuidOrFail(Role $role, string $uuid): Permission
    {
        return $role->permissions()
                    ->where('uuid', '=', $uuid)
                    ->firstOrFail();
    }

    /**
     * Get roles with the given list of `key` (attribute).
     *
     * @param  array  $keys
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Role[]|\Illuminate\Support\Collection|iterable
     */
    public function getByKeys(array $keys): iterable
    {
        return $this->whereIn('key', $keys)->get();
    }

    /**
     * Get roles with the given list of `uuid` (attribute).
     *
     * @param  array  $uuids
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Role[]|\Illuminate\Support\Collection|iterable
     */
    public function getByUuids($uuids): iterable
    {
        return $this->whereIn('uuid', $uuids)->get();
    }

    /**
     * Create a new role.
     *
     * @param  array  $attributes
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Role|mixed
     */
    public function createOne(array $attributes)
    {
        return tap($this->create($attributes), function (Role $role) use ($attributes) {
            $this->syncPermissionsByUuids($role, $attributes['permissions'] ?: []);
        });
    }

    /**
     * Update the given role.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role  $role
     * @param  array                                    $attributes
     *
     * @return bool
     */
    public function updateOne(Role $role, array $attributes): bool
    {
        return $role->update($attributes);
    }

    /**
     * Sync permissions by the given uuids.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role|mixed  $role
     * @param  array                                          $uuids
     *
     * @return array
     */
    public function syncPermissionsByUuids(Role $role, array $uuids): array
    {
        $ids = static::makeRepository(PermissionsRepository::class)
            ->getIdsWhereInUuid($uuids)
            ->toArray();

        return $this->syncPermissionsByIds($role, $ids);
    }

    /**
     * Sync the permissions by the given ids.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role|mixed  $role
     * @param  array                                          $ids
     *
     * @return array
     */
    public function syncPermissionsByIds(Role $role, array $ids): array
    {
        if (empty($ids))
            return [];

        event(new SyncingPermissions($role, $ids));
        $synced = $role->permissions()->sync($ids);
        event(new SyncedPermissions($role, $ids, $synced));

        return $synced;
    }

    /**
     * Detach the given permission from role.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role        $role
     * @param  \Arcanesoft\Foundation\Auth\Models\Permission  $permission
     *
     * @return int
     */
    public function detachPermission(Role $role, Permission $permission): int
    {
        event(new DetachingPermission($role, $permission));
        $detached = $role->permissions()->detach($permission);
        event(new DetachedPermission($role, $permission, $detached));

        return $detached;
    }

    /**
     * Detach all the permissions from the given role.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role  $role
     *
     * @return int
     */
    public function detachAllPermissions(Role $role): int
    {
        event(new DetachingAllPermissions($role));
        $detached = $role->permissions()->detach();
        event(new DetachedAllPermissions($role, $detached));

        return $detached;
    }

    /**
     * Detach the given user from role.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role  $role
     * @param  \Arcanesoft\Foundation\Auth\Models\User  $user
     *
     * @return int
     */
    public function detachUser(Role $role, User $user): int
    {
        event(new DetachingUser($role, $user));
        $detached = $role->users()->detach($user);
        event(new DetachedUser($role, $user, $detached));

        return $detached;
    }

    /**
     * Detach all the users from the given role.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role  $role
     *
     * @return int
     */
    public function detachAllUsers(Role $role): int
    {
        event(new DetachingAllUsers($role));
        $detached = $role->users()->detach();
        event(new DetachedAllUsers($role, $detached));

        return $detached;
    }

    /**
     * Get the active roles count.
     *
     * @return int
     */
    public function activeCount(): int
    {
        return $this->activated()->count();
    }

    /**
     * Activate/Deactivate the given role.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role  $role
     *
     * @return bool
     */
    public function toggleActive(Role $role): bool
    {
        return $role->isActive() ? $role->deactivate() : $role->activate();
    }

    /**
     * Delete the given role.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role  $role
     *
     * @return bool|null
     */
    public function deleteOne(Role $role)
    {
        return $role->delete();
    }

    /**
     * Get the roles filtered by authenticated administrator.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin|mixed  $admin
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Role[]|\Illuminate\Support\Collection|iterable
     */
    public function getFilteredByAuthenticatedUser(Admin $admin): iterable
    {
        $roles = $this->get();

        if ($admin->isSuperAdmin()) {
            return $roles;
        }

        return $roles->filter(function (Role $role) {
            return $role->key !== Role::ADMINISTRATOR;
        });
    }
}
