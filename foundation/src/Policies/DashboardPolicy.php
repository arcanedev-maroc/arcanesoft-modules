<?php

namespace Arcanesoft\Foundation\Policies;

use App\Models\User as AuthenticatedUser;

/**
 * Class     DashboardPolicy
 *
 * @package  Arcanesoft\Foundation\Policies
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
     * @var string|null
     */
    protected $prefix = 'admin::foundation.dashboard.';

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

            // admin::foundation.dashboard.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'Access the main dashboard',
                'description' => 'Ability to access the main dashboard',
            ]),

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
        if ($user->isModerator())
            return true;
    }
}
