<?php

declare(strict_types=1);

namespace Arcanesoft\Backups\Seeders;

use Arcanesoft\Foundation\Support\Database\Seeder;

/**
 * Class     DatabaseSeeder
 *
 * @package  Arcanesoft\Backups\Seeders
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DatabaseSeeder extends Seeder
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Seeders collection.
     *
     * @var array
     */
    protected $seeders = [
        PermissionsTableSeeder::class,
        RolesTableSeeder::class,
    ];
}
