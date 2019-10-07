<?php

namespace Arcanesoft\Foundation\Policies\System;

use App\Models\User as AuthenticatedUser;
use Arcanesoft\Foundation\Core\Auth\Policy;

/**
 * Class     MaintenancePolicy
 *
 * @package  Arcanesoft\Foundation\Policies\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MaintenancePolicy extends Policy
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
        return 'admin::foundation.system.maintenance.';
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
            'category' => 'Maintenance Mode',
        ]);

        return [

            // admin::foundation.system.maintenance.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'Show the maintenance details',
                'description' => 'Ability to access the maintenance details',
            ]),

            // admin::foundation.system.maintenance.toggle
            $this->makeAbility('toggle')->setMetas([
                'name'        => 'Toggle the maintenance mode',
                'description' => 'Ability to toggle the maintenance mode',
            ]),

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
     * @return \Illuminate\Auth\Access\Response|bool|void
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
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function toggle(AuthenticatedUser $user)
    {
        //
    }
}
