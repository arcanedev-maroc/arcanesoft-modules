<?php namespace Arcanesoft\Foundation\Policies\System;

use App\Models\User as AuthenticatedUser;
use Arcanesoft\Support\Policies\Policy;

/**
 * Class     RouteViewerPolicy
 *
 * @package  Arcanesoft\Foundation\Policies\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RouteViewerPolicy extends Policy
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
        return 'admin::foundation.system.route-viewer';
    }

    /**
     * Get the policy metas.
     *
     * @return array
     */
    public static function metas(): array
    {
        return [
            static::meta('index') // admin::foundation.system.route-viewer.index
                  ->name('Show all the routes')
                  ->description('Ability to show all the routes'),
        ];
    }

    /* -----------------------------------------------------------------
     |  Policies
     | -----------------------------------------------------------------
     */

    /**
     * Allow to access all the routes.
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
