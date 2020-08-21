<?php

declare(strict_types=1);

namespace Arcanesoft\Seo\Seeders;

use Arcanesoft\Foundation\Auth\Database\Seeders\PermissionsSeeder;

/**
 * Class     PermissionTableSeeder
 *
 * @package  Arcanesoft\Seo\Seeders
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
            'name'        => 'SEO',
            'slug'        => 'seo',
            'description' => 'SEO permissions group',
        ], $this->getPermissionsFromPolicyManager('admin::seo.'));
    }
}