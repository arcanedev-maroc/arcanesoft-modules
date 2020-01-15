<?php

declare(strict_types=1);

namespace Arcanesoft\Seo\Seeders;

use Arcanesoft\Foundation\Support\Database\Seeder;
use Arcanesoft\Seo\Seeders\PermissionTableSeeder;
use Arcanesoft\Seo\Seeders\RoleTableSeeder;

/**
 * Class     DatabaseSeeder
 *
 * @package  Arcanesoft\Seo\Seeders
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