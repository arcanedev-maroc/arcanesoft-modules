<?php

namespace Arcanesoft\Foundation\Policies;

use App\Models\User as AuthenticatedUser;
use Arcanesoft\Foundation\Core\Auth\Policy;

/**
 * Class     DashboardPolicy
 *
 * @package  Arcanesoft\Foundation\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DashboardPolicy extends Policy
{
    /* -----------------------------------------------------------------
     |  Getters
     | -----------------------------------------------------------------
     */

    /**
     * Get the ability's prefix.
     *
     * @return string
     */
    protected static function prefix(): string
    {
        return 'admin::foundation.dashboard.';
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the policy's abilities.
     *
     * @return \Arcanedev\LaravelPolicies\Ability[]|iterable
     */
    public function abilities(): iterable
    {
        $this->setMetas([
            'category' => 'Dashboard',
        ]);

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
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function index(AuthenticatedUser $user)
    {
        if ($user->isModerator())
            return true;
    }
}
