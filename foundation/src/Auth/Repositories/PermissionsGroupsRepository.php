<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Repositories;

use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Auth\Models\PermissionsGroup;

/**
 * Class     PermissionsGroupsRepository
 *
 * @package  Arcanesoft\Foundation\Auth\Repositories
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @mixin  \Arcanesoft\Foundation\Auth\Models\PermissionsGroup
 */
class PermissionsGroupsRepository extends AbstractRepository
{
    /* -----------------------------------------------------------------
     |  Query Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the permission instance.
     *
     * @return \Arcanesoft\Foundation\Auth\Models\PermissionsGroup|mixed
     */
    public static function model()
    {
        return Auth::makeModel('permissions-group', PermissionsGroup::class);
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Save permissions to the group.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\PermissionsGroup       $group
     * @param  \Arcanesoft\Foundation\Auth\Models\Permission[]|iterable  $permissions
     *
     * @return iterable
     */
    public function savePermissions(PermissionsGroup $group, iterable $permissions)
    {
        return $group->permissions()->saveMany($permissions);
    }
}