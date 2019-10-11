<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Seeders;

use Arcanesoft\Foundation\Support\Database\Seeder;

/**
 * Class     DatabaseSeeder
 *
 * @package  Arcanesoft\Foundation\Seeders
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DatabaseSeeder extends Seeder
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Seeder collection.
     *
     * @var array
     */
    protected $seeders = [
        PermissionTableSeeder::class,
        RoleTableSeeder::class,
    ];
}
