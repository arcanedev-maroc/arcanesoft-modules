<?php

declare(strict_types=1);

namespace Arcanesoft\Media\Seeders;

use Arcanesoft\Foundation\Auth\Database\Seeders\PermissionsSeeder;

/**
 * Class     PermissionTableSeeder
 *
 * @package  Arcanesoft\Media\Seeders
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
            'name'        => 'Media',
            'slug'        => 'media',
            'description' => 'Media permissions group',
        ], $this->getPermissionsFromPolicyManager('admin::media.'));
    }
}
