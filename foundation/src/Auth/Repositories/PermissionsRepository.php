<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Repositories;

use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Auth\Events\Permissions\{DetachedRoleFromPermission, DetachingRoleFromPermission};
use Arcanesoft\Foundation\Auth\Models\{Permission, Role};
use Illuminate\Support\Collection;

/**
 * Class     PermissionsRepository
 *
 * @package  Arcanesoft\Foundation\Auth\Repositories
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @mixin  \Arcanesoft\Foundation\Auth\Models\Permission
 */
class PermissionsRepository extends AbstractRepository
{
    /* -----------------------------------------------------------------
     |  Query Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the permission instance.
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Permission|mixed
     */
    public static function model()
    {
        return Auth::makeModel('permission');
    }

    /* -----------------------------------------------------------------
     |  CRUD Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get all the permissions' ids.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllIds(): Collection
    {
        return $this->pluck('id');
    }

    /**
     * Get first permission with the given uuid, or fails.
     *
     * @param  string  $uuid
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Permission|mixed
     */
    public function firstOrFailWhereUuid(string $uuid)
    {
        return $this->where('uuid', '=', $uuid)->firstOrFail();
    }

    /**
     * Get first role related to the permission by given uuid, or fail if not found.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Permission  $permission
     * @param  string                                         $uuid
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Role|mixed
     */
    public function firstRoleWhereUuidOrFail(Permission $permission, string $uuid)
    {
        return $permission->roles()->where('uuid', $uuid)->firstOrFail();
    }

    /**
     * Get permissions' ids where in the given uuids.
     *
     * @param  array  $uuids
     *
     * @return \Illuminate\Support\Collection
     */
    public function getIdsWhereInUuid(array $uuids): Collection
    {
        return $this->whereIn('uuid', $uuids)->pluck('id');
    }

    /**
     * Detach role from permission.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Permission  $permission
     * @param  \Arcanesoft\Foundation\Auth\Models\Role        $role
     *
     * @return int
     */
    public function detachRole(Permission $permission, Role $role): int
    {
        event(new DetachingRoleFromPermission($permission, $role));
        $detached = $permission->roles()->detach($role);
        event(new DetachedRoleFromPermission($permission, $role, $detached));

        return $detached;
    }
}
