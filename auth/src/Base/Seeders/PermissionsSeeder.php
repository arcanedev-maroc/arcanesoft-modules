<?php namespace Arcanesoft\Auth\Base\Seeders;

use Arcanedev\Support\Database\Seeder;
use Arcanesoft\Auth\Models\Permission;
use Arcanesoft\Auth\Models\PermissionsGroup;
use Illuminate\Support\Str;

/**
 * Class     PermissionsSeeder
 *
 * @package  Arcanesoft\Auth\Base\Seeders
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
        return collect($policies)
            ->transform(function ($options, $class) {
                /** @var  \Illuminate\Support\Collection  $seeds */
                $seeds = $class::seeds(
                    static::getPermissionsCategory($options, $class)
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
     * @param  array   $options
     * @param  string  $class
     *
     * @return string
     */
    protected static function getPermissionsCategory(array $options, string $class): string
    {
        $category = $options['category'] ?? Str::snake(str_replace('Policy', '', class_basename($class)), ' ');

        return ucwords($category);
    }
}
