<?php namespace Arcanesoft\Foundation\Seeders;

use Arcanesoft\Auth\Base\Seeders\RolesSeeder;

/**
 * Class     RoleTableSeeder
 *
 * @package  Arcanesoft\Foundation\Seeders
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
        //

        static::syncAdminRole();
    }
}
