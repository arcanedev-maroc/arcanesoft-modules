<?php

declare(strict_types=1);

namespace Arcanesoft\Backups\Seeders;

use Arcanesoft\Foundation\Auth\Database\Seeders\RolesSeeder;

/**
 * Class     RolesTableSeeder
 *
 * @package  Arcanesoft\Backups\Seeders
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RolesTableSeeder extends RolesSeeder
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
        $this->seedMany([
            [
                'name'        => 'Backups Manager',
                'description' => 'The Backups manager role.',
                'is_locked'   => true,
            ],
        ]);

        $this->syncRoles([
            'backups-manager' => [
                'admin::backups.*',
            ],
        ]);
    }
}
