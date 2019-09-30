<?php namespace Arcanesoft\Foundation\Policies\System;

use App\Models\User as AuthenticatedUser;
use Arcanesoft\Support\Policies\Policy;

/**
 * Class     InformationPolicy
 *
 * @package  Arcanesoft\Foundation\Policies\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class InformationPolicy extends Policy
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
        return 'admin::foundation.system';
    }
    /**
     * Get the policy metas.
     *
     * @return array
     */
    public static function metas(): array
    {
        return [
            static::meta('index') // admin::foundation.system.index
                  ->name('Show all the system information')
                  ->description('Ability to show all the system information'),
        ];
    }

    /* -----------------------------------------------------------------
     |  Policies
     | -----------------------------------------------------------------
     */

    /**
     * Allow to access all the system information.
     *
     * @param  \App\Models\User  $user
     *
     * @return bool|void
     */
    public function index(AuthenticatedUser $user)
    {
        //
    }
}
