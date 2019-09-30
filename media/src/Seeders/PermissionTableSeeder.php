<?php namespace Arcanesoft\Media\Seeders;

use Arcanesoft\Foundation\Policies;
use Arcanesoft\Auth\Base\Seeders\PermissionsSeeder;

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
    public function run()
    {
        $this->seedOne([
            'group'       => [
                'name'        => 'Media',
                'slug'        => 'media',
                'description' => 'Media permissions group',
            ],
            'permissions' => static::getPermissionsFromPolicies(
                config()->get('arcanesoft.media.policies', [])
            ),
        ]);
    }
}
