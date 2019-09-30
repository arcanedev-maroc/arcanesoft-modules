<?php namespace Arcanesoft\Blog\Seeders;

use Arcanesoft\Auth\Base\Seeders\RolesSeeder;

/**
 * Class     RoleTableSeeder
 *
 * @package  Arcanesoft\Blog\Seeders
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RoleTableSeeder extends RolesSeeder
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->seed([
            [
                'name'        => 'Blog Moderator',
                'key'         => 'blog-moderator',
                'description' => 'The blog moderator role',
                'is_locked'   => true,
            ],
            [
                'name'        => 'Blog Author',
                'key'         => 'blog-author',
                'description' => 'The blog author role',
                'is_locked'   => true,
            ],
        ]);

        $this->syncRoles([
            'blog-moderator' => [
                'admin::blog.*'
            ],
            'blog-author'    => [
                'admin::blog.posts.*',
                'admin::blog.tags.*',
            ],
        ]);

        static::syncAdminRole();
    }
}
