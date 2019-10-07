<?php

namespace Arcanesoft\Backups\Seeders;

use Arcanesoft\Support\Database\Seeder;

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
