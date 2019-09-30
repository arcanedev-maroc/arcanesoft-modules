<?php namespace Arcanesoft\Auth\Repositories;

use Arcanesoft\Auth\Auth;
use Arcanesoft\Auth\Models\Role as Role;

/**
 * Class     RolesRepository
 *
 * @package  Arcanesoft\Auth\Repositories
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RolesRepository
{
    /* -----------------------------------------------------------------
     |  Query Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the model instance.
     *
     * @return Role|mixed
     */
    public function model()
    {
        return Auth::makeModel('role');
    }

    /**
     * Get the query builder.
     *
     * @return Role|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->model()->newQuery();
    }

    /* -----------------------------------------------------------------
     |  Count Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get all the roles.
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->query()->get();
    }

    /**
     * Create a new role.
     *
     * @param  array  $attributes
     *
     * @return Role|mixed
     */
    public function create(array $attributes)
    {
        $role = $this->model()->fill($attributes);
        $role->save();

        // Sync the permissions
        foreach ($this->getPermissionsIdsByUuid($attributes['permissions']) as $permission) {
            $role->attachPermission($permission);
        }

        return $role;
    }

    /**
     * Update the given role.
     *
     * @param  \Arcanesoft\Auth\Models\Role  $role
     * @param  array                         $attributes
     *
     * @return bool
     */
    public function update(Role $role, array $attributes)
    {
        $updated = $role->update($attributes);

        if ($attributes['permissions'])
            $role->syncPermissions(
                $this->getPermissionsIdsByUuid($attributes['permissions'])
            );
        else
            $role->detachAllPermissions(false);

        return $updated;
    }

    /**
     * Get the roles count.
     *
     * @return int
     */
    public function count()
    {
        return $this->query()->count();
    }

    /**
     * Get the active roles count.
     *
     * @return int
     */
    public function activeCount()
    {
        return $this->query()->activated()->count();
    }

    /**
     * Get the permissions' ids by the given uuid array.
     *
     * @param  array  $uuid
     *
     * @return array
     */
    private function getPermissionsIdsByUuid(array $uuid): array
    {
        return (new PermissionsRepository)
            ->query()
            ->whereIn('uuid', $uuid)
            ->pluck('id')
            ->toArray();
    }

    /**
     * Activate/Deactivate the given role.
     *
     * @param  \Arcanesoft\Auth\Models\Role  $role
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
     * @param  \Arcanesoft\Auth\Models\Role  $role
     *
     * @return bool|null
     */
    public function delete(Role $role)
    {
        return $role->delete();
    }
}
