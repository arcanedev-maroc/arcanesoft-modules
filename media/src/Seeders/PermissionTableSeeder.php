<?php namespace Arcanesoft\Media\Seeders;

use Arcanesoft\Auth\Database\Seeders\PermissionsSeeder;

/**
 * Class     PermissionTableSeeder
 *
 * @package  Arcanesoft\Media\Seeders
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
        $policies = config()->get('arcanesoft.media.policies', []);

        $this->seedOne([
            'group'       => [
                'name'        => 'Media',
                'slug'        => 'media',
                'description' => 'Media permissions group',
            ],
            'permissions' => static::getPermissionsFromPolicies($policies),
        ]);
    }
}
