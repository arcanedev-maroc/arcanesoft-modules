<?php

namespace Arcanesoft\Auth\Database\Seeders;

use Arcanesoft\Support\Database\Seeder;
use Arcanesoft\Auth\Models\{Permission, PermissionsGroup};
use Illuminate\Support\{Collection, Str};

/**
 * Class     PermissionsSeeder
 *
 * @package  Arcanesoft\Auth\Database\Seeders
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class PermissionsSeeder extends Seeder
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Seed permissions for multiple groups.
     *
     * @param  array  $seeds
     */
    public function seed(array $seeds)
    {
        foreach ($seeds as $seed) {
            $this->seedOne($seed);
        }
    }

    /**
     * Seed permissions for one group.
     *
     * @param  array  $group
     */
    public function seedOne(array $group)
    {
        static::createPermissionGroup($group);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Create permissions group.
     *
     * @param  array  $seed
     *
     * @return \Arcanesoft\Auth\Models\PermissionsGroup
     */
    protected static function createPermissionGroup(array $seed)
    {
        return tap(
            PermissionsGroup::query()->create($seed['group']),
            function (PermissionsGroup $group) use ($seed) {
                $permissions = array_map(function ($permission) {
                    return new Permission($permission);
                }, $seed['permissions']);

                $group->permissions()->saveMany($permissions);
            }
        );
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the permissions
     *
     * @param  array  $policies
     *
     * @return array
     */
    protected static function getPermissionsFromPolicies(array $policies): array
    {
        return Collection::make($policies)
            ->transform(function ($class) {
                /** @var  \Illuminate\Support\Collection  $seeds */
                $seeds = $class::seeds(
                    static::getPermissionsCategory($class)
                );

                return $seeds->transform(function ($permission) {
                    return array_merge($permission, [
                        'uuid' => Str::uuid(),
                    ]);
                })->toArray();
            })
            ->flatten(1)
            ->toArray();
    }

    /**
     * Get the permissions' category.
     *
     * @param  string  $class
     *
     * @return string
     */
    protected static function getPermissionsCategory(string $class): string
    {
        return ucwords(Str::snake(str_replace('Policy', '', class_basename($class)), ' '));
    }
}
