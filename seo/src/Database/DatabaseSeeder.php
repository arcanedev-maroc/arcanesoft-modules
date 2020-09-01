<?php

declare(strict_types=1);

namespace Arcanesoft\Seo\Database;

use Arcanesoft\Foundation\Support\Database\Seeder;
use Arcanesoft\Seo\Database\Seeders\{PermissionSeeder, RoleSeeder};

/**
 * Class     DatabaseSeeder
 *
 * @package  Arcanesoft\Seo\Database
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DatabaseSeeder extends Seeder
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the seeders.
     *
     * @return array
     */
    public function seeders(): array
    {
        return [
            PermissionSeeder::class,
            RoleSeeder::class,
        ];
    }
}
