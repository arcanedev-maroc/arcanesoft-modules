<?php namespace Arcanesoft\Auth\Seeders;

use Arcanedev\Support\Database\Seeder;

/**
 * Class     DatabaseSeeder
 *
 * @package  Arcanesoft\Auth\Seeders
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
        UserTableSeeder::class,
    ];
}
