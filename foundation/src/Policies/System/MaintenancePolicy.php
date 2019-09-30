<?php namespace Arcanesoft\Foundation\Policies\System;

use App\Models\User as AuthenticatedUser;
use Arcanesoft\Support\Policies\Policy;

/**
 * Class     MaintenancePolicy
 *
 * @package  Arcanesoft\Foundation\Policies\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MaintenancePolicy extends Policy
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the policy's prefix.
     *
     * @return string
     */
    public static function prefix(): string
    {
        return 'admin::foundation.system.maintenance';
    }

    /**
     * Get the policy metas.
     *
     * @return array
     */
    public static function metas(): array
    {
        return [
            static::meta('index') // admin::foundation.system.maintenance.index
                  ->name('Show the maintenance details')
                  ->description('Ability to access the maintenance details'),

            static::meta('toggle') // admin::foundation.system.maintenance.toggle
                  ->name('Toggle the maintenance mode')
                  ->description('Ability to toggle the maintenance mode'),
        ];
    }

    /* -----------------------------------------------------------------
     |  Policies
     | -----------------------------------------------------------------
     */

    /**
     * Allow to access the maintenance details.
     *
     * @param  \App\Models\User  $user
     *
     * @return bool|void
     */
    public function index(AuthenticatedUser $user)
    {
        //
    }

    /**
     * Allow to toggle the maintenance mode.
     *
     * @param  \App\Models\User  $user
     *
     * @return bool|void
     */
    public function toggle(AuthenticatedUser $user)
    {
        //
    }
}
