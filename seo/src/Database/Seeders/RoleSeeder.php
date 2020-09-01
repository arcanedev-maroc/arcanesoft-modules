<?php

declare(strict_types=1);

namespace Arcanesoft\Seo\Database\Seeders;

use Arcanesoft\Foundation\Core\Database\RolesSeeder as Seeder;

/**
 * Class     RoleSeeder
 *
 * @package  Arcanesoft\Seo\Database\Seeders
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RoleSeeder extends Seeder
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
                'name'        => 'SEO Moderator',
                'key'         => 'seo-moderator',
                'description' => 'The SEO moderator role',
                'is_locked'   => true,
            ],
        ]);

        $this->syncRolesWithPermissions([
            'blog-moderator' => [
                'admin::seo.*'
            ],
        ]);
    }
}
