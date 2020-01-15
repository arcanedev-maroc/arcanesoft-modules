<?php

declare(strict_types=1);

namespace Arcanesoft\Seo\Seeders;

use Arcanesoft\Foundation\Auth\Database\Seeders\RolesSeeder;

/**
 * Class     RoleTableSeeder
 *
 * @package  Arcanesoft\Seo\Seeders
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RoleTableSeeder extends RolesSeeder
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

        $this->syncRoles([
            'blog-moderator' => [
                'admin::seo.*'
            ],
        ]);
    }
}