<?php namespace Arcanesoft\Foundation\Policies\System;

use App\Models\User as AuthenticatedUser;
use Arcanesoft\Foundation\Policies\AbstractPolicy;

/**
 * Class     MaintenancePolicy
 *
 * @package  Arcanesoft\Foundation\Policies\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MaintenancePolicy extends AbstractPolicy
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
    protected $prefix = 'admin::foundation.system.maintenance.';

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
