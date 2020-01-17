<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Seeders;

use Arcanesoft\Foundation\Support\Database\Seeder;

/**
 * Class     DatabaseSeeder
 *
 * @package  Arcanesoft\Foundation\Core\Seeders
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