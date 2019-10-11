<?php

declare(strict_types=1);

namespace Arcanesoft\Blog\Seeders;

use Arcanesoft\Foundation\Support\Database\Seeder;

/**
 * Class     DatabaseSeeder
 *
 * @package  Arcanesoft\Blog\Seeders
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DatabaseSeeder extends Seeder
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The seeders list.
     *
     * @var array
     */
    protected $seeders = [
        PermissionTableSeeder::class,
        RoleTableSeeder::class,
    ];
}
