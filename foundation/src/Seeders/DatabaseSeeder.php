<?php namespace Arcanesoft\Foundation\Seeders;

use Arcanedev\Support\Database\Seeder;

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
    protected $seeds = [
        PermissionTableSeeder::class,
        RoleTableSeeder::class,
    ];
}
