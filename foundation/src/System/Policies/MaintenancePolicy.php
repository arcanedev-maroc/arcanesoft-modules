<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Policies;

use Arcanesoft\Foundation\Auth\Models\User as AuthenticatedUser;

/**
 * Class     MaintenancePolicy
 *
 * @package  Arcanesoft\Foundation\System\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MaintenancePolicy extends AbstractPolicy
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
        return 'admin::system.maintenance.';
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
     * @param  \Arcanesoft\Foundation\Auth\Models\User|mixed  $user
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
     * @param  \Arcanesoft\Foundation\Auth\Models\User|mixed  $user
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function toggle(AuthenticatedUser $user)
    {
        //
    }
}
