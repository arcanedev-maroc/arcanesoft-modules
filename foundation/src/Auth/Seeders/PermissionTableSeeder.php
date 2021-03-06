<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Seeders;

use Arcanesoft\Foundation\Auth\Database\Seeders\PermissionsSeeder;

/**
 * Class     PermissionTableSeeder
 *
 * @package  Arcanesoft\Foundation\Auth\Seeders
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
            'name'        => 'Auth',
            'slug'        => 'auth',
            'description' => 'Auth permissions group',
        ], $this->getPermissionsFromPolicyManager('admin::auth.'));
    }
}
