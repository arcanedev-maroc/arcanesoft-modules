<?php

namespace Arcanesoft\Auth\Policies;

use App\Models\User as AuthenticatedUser;

/**
 * Class     DashboardPolicy
 *
 * @package  Arcanesoft\Auth\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DashboardPolicy extends AbstractPolicy
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Ability's prefix.
     *
     * @var string
     */
    protected $prefix = 'admin::auth.statistics.';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the policy's abilities.
     *
     * @return \Arcanesoft\Support\Policies\Ability[]|array
     */
    public function abilities(): array
    {
        return [

            // admin::auth.statistics.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'Show all the statistics',
                'description' => 'Ability to show all the statistics',
            ]),

        ];
    }

    /* -----------------------------------------------------------------
     |  Abilities
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
