<?php

declare(strict_types=1);

namespace Arcanesoft\Blog\Seeders;

use Arcanesoft\Foundation\Auth\Database\Seeders\PermissionsSeeder;

/**
 * Class     PermissionTableSeeder
 *
 * @package  Arcanesoft\Blog\Seeders
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PermissionTableSeeder extends PermissionsSeeder
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seed([
            'name'        => 'Blog',
            'slug'        => 'blog',
            'description' => 'Blog permissions group',
        ], $this->getPermissionsFromPolicyManager('admin::blog.'));
    }
}
