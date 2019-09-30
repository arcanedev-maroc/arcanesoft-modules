<?php namespace Arcanesoft\Auth\Seeders;

use Arcanesoft\Auth\Models\Role;
use Arcanesoft\Auth\Base\Seeders\RolesSeeder;

/**
 * Class     RoleTableSeeder
 *
 * @package  Arcanesoft\Auth\Seeders
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
                'name'        => 'Administrator',
                'key'         => Role::ADMINISTRATOR,
                'description' => 'The system administrator role',
                'is_locked'   => true,
            ],
            [
                'name'        => 'Moderator',
                'key'         => Role::MODERATOR,
                'description' => 'The system moderator role',
                'is_locked'   => true,
            ],
            [
                'name'        => 'Member',
                'key'         => Role::MEMBER,
                'description' => 'The member role',
                'is_locked'   => true,
            ],
            [
                'name'        => 'Auth Moderator',
                'key'         => 'auth-moderator',
                'description' => 'The auth moderator role',
                'is_locked'   => true,
            ],
        ]);

        $this->syncRoles([
            'auth-moderator' => [
                'admin::auth.*',
            ],
        ]);

        static::syncAdminRole();
    }
}
