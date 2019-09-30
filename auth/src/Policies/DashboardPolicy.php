<?php namespace Arcanesoft\Auth\Policies;

use App\Models\User as AuthenticatedUser;
use Arcanesoft\Support\Policies\Policy;

/**
 * Class     DashboardPolicy
 *
 * @package  Arcanesoft\Auth\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DashboardPolicy extends Policy
{
    /* -----------------------------------------------------------------
     |  Policies
     | -----------------------------------------------------------------
     */

    /**
     * Allow to access all the auth stats.
     *
     * @param  \App\Models\User  $user
     *
     * @return bool|void
     */
    public function index(AuthenticatedUser $user)
    {
        //
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the policy's prefix.
     *
     * @return string
     */
    public static function prefix(): string
    {
        return 'admin::auth.statistics';
    }

    /**
     * Get the policy metas.
     *
     * @return array
     */
    public static function metas(): array
    {
        return [
            static::meta('index') // admin::auth.statistics.index
                  ->name('Show all the statistics')
                  ->description('Ability to show all the statistics'),
        ];
    }
}
