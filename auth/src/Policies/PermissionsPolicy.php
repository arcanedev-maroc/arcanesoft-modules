<?php

namespace Arcanesoft\Auth\Policies;

use App\Models\User as AuthenticatedUser;

/**
 * Class     PermissionsPolicy
 *
 * @package  Arcanesoft\Auth\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PermissionsPolicy extends AbstractPolicy
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
    protected $prefix = 'admin::auth.permissions.';

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

            // auth.permissions.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'List all the permissions',
                'description' => 'Ability to list all the permissions',
            ]),

            // auth.permissions.show
            $this->makeAbility('show')->setMetas([
                'name'         => 'Show a permission',
                'description'  => "Ability to show the permission's details",
            ]),

        ];
    }

    /* -----------------------------------------------------------------
     |  Abilities
     | -----------------------------------------------------------------
     */

    /**
     * Allow to list all the roles.
     *
     * @param  \App\Models\User|mixed  $user
     *
     * @return bool|void
     */
    public function index(AuthenticatedUser $user)
    {
        //
    }

    /**
     * Allow to show a role details.
     *
     * @param  \App\Models\User|mixed  $user
     *
     * @return bool|void
     */
    public function show(AuthenticatedUser $user)
    {
        //
    }
}
