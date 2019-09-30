<?php namespace Arcanesoft\Media\Seeders;

use Arcanedev\Support\Database\Seeder;

/**
 * Class     DatabaseSeeder
 *
 * @package  Arcanesoft\Media\Seeders
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
