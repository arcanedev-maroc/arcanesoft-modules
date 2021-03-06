<?php

namespace Arcanesoft\Backups\Seeders;

use Arcanesoft\Auth\Database\Seeders\PermissionsSeeder;

/**
 * Class     PermissionsTableSeeder
 *
 * @package  Arcanesoft\Backups\Seeders
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PermissionsTableSeeder extends PermissionsSeeder
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
            'name'        => 'Backups',
            'slug'        => 'backups',
            'description' => 'backups permissions group',
        ], $this->getPermissionsFromPolicyManager('admin::backups.'));
    }
}
