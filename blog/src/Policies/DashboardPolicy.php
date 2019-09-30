<?php namespace Arcanesoft\Blog\Policies;

use App\Models\User as AuthenticatedUser;
use Arcanesoft\Support\Policies\Policy;

/**
 * Class     DashboardPolicy
 *
 * @package  Arcanesoft\Blog\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DashboardPolicy extends Policy
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
        return 'admin::blog.statistics';
    }

    /**
     * Get the policy metas.
     *
     * @return array
     */
    public static function metas(): array
    {
        return [
            static::meta('index') // admin::blog.statistics.index
            ->name('Show all the statistics')
                ->description('Ability to show all the statistics'),
        ];
    }

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
}
