<?php namespace Arcanesoft\Auth\Seeders;

use Arcanesoft\Auth\Base\Seeders\PermissionsSeeder;

/**
 * Class     PermissionTableSeeder
 *
 * @package  Arcanesoft\Auth\Seeders
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
                'name'        => 'Auth',
                'slug'        => 'auth',
                'description' => 'Auth permissions group',
            ],
            'permissions' => static::getPermissionsFromPolicies(
                config()->get('arcanesoft.auth.policies', [])
            ),
        ]);
    }
}
