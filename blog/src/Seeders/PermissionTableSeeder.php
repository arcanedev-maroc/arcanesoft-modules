<?php

namespace Arcanesoft\Blog\Seeders;

use Arcanesoft\Auth\Database\Seeders\PermissionsSeeder;

/**
 * Class     PermissionTableSeeder
 *
 * @package  Arcanesoft\Blog\Seeders
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PermissionTableSeeder extends PermissionsSeeder
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $policies = config()->get('arcanesoft.blog.policies', []);

        $this->seedOne([
            'group'       => [
                'name'        => 'Blog',
                'slug'        => 'blog',
                'description' => 'Blog permissions group',
            ],
            'permissions' => static::getPermissionsFromPolicies($policies),
        ]);
    }
}
