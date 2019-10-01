<?php

namespace Arcanesoft\Foundation\Seeders;

use Arcanesoft\Auth\Database\Seeders\PermissionsSeeder;

/**
 * Class     PermissionTableSeeder
 *
 * @package  Arcanesoft\Foundation\Seeders
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
        $this->seedOne([
            'group'       => [
                'name'        => 'Foundation',
                'slug'        => 'foundation',
                'description' => 'Foundation permissions group',
            ],
            'permissions' => static::getPermissionsFromPolicies(
                config()->get('arcanesoft.foundation.policies', [])
            ),
        ]);
    }
}
