<?php

declare(strict_types=1);

namespace Arcanesoft\Seo\Database\Seeders;

use Arcanesoft\Foundation\Core\Database\PermissionsSeeder as Seeder;

/**
 * Class     PermissionSeeder
 *
 * @package  Arcanesoft\Seo\Database\Seeders
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PermissionSeeder extends Seeder
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
            'name'        => 'SEO',
            'slug'        => 'seo',
            'description' => 'SEO permissions group',
        ], $this->getPermissionsFromPolicyManager('admin::seo.'));
    }
}
