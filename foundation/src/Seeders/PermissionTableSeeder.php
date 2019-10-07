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
        $this->seed([
            'name'        => 'Foundation',
            'slug'        => 'foundation',
            'description' => 'Foundation permissions group',
        ], $this->getPermissionsFromPolicyManager('admin::foundation.'));
    }
}
