<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Seeders;

use Arcanesoft\Foundation\Auth\Database\Seeders\PermissionsSeeder;

/**
 * Class     PermissionTableSeeder
 *
 * @package  Arcanesoft\Foundation\Core\Seeders
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
            'name'        => 'Core',
            'slug'        => 'core',
            'description' => 'Core permissions group',
        ], $this->getPermissionsFromPolicyManager([
            'admin::dashboard.index',
        ]));
    }
}