<?php

namespace Arcanesoft\Auth\Database\Seeders;

use Arcanesoft\Support\Database\Seeder;
use Arcanesoft\Auth\Auth;
use Arcanesoft\Auth\Models\{Permission, Role};
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\{Arr, Carbon, Str};

/**
 * Class     RolesSeeder
 *
 * @package  Arcanesoft\Auth\Database\Seeders
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class RolesSeeder extends Seeder
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Seed roles.
     *
     * @param  array  $roles
     */
    public function seed(array $roles): void
    {
        $roles = static::prepareRoles($roles);

        Role::query()->insert($roles);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Prepare roles to seed.
     *
     * @param  array  $roles
     *
     * @return array
     */
    protected static function prepareRoles(array $roles): array
    {
        $now = Carbon::now();

        return array_map(function ($role) use ($now) {
            return array_merge($role, [
                'uuid'         => $role['uuid'] ?? Str::uuid(),
                'key'          => $role['key'] ?? Auth::slugRoleKey($role['name']),
                'is_locked'    => $role['is_locked'] ?? true,
                'activated_at' => $now,
                'created_at'   => $now,
                'updated_at'   => $now,
            ]);
        }, $roles);
    }

    /**
     * Sync the admin role with all permissions.
     */
    protected static function syncAdminRole(): void
    {
        tap(Role::admin()->first(), function (Role $role) {
            $role->permissions()->sync(
                Permission::all()->pluck('id')->toArray()
            );
        });
    }

    /**
     * Sync the roles.
     *
     * @param  array  $roles
     */
    protected function syncRoles(array $roles): void
    {
        $permissions = Permission::all();

        foreach ($roles as $roleKey => $abilities) {
            /** @var  \Arcanesoft\Auth\Models\Role  $role */
            if ($role = Role::query()->where('key', $roleKey)->first()) {
                $role->permissions()->sync(
                    $this->getAllowedPermissions($permissions, $abilities)
                );
            }
        }
    }

    /**
     * Get the allowed permissions' ids.
     *
     * @param  \Illuminate\Database\Eloquent\Collection  $permissions
     * @param  array|string                              $abilities
     *
     * @return array
     */
    private function getAllowedPermissions(Collection $permissions, $abilities): array
    {
        $abilities = Arr::wrap($abilities);

        return $permissions->filter(function (Permission $permission) use ($abilities) {
            foreach ($abilities as $ability) {
                if (Str::startsWith($permission->ability, $ability) || Str::is($ability, $permission->ability))
                    return true;
            }

            return false;
        })->pluck('id')->toArray();
    }
}
