<?php

namespace Arcanesoft\Auth\Policies;

use App\Models\User as AuthenticatedUser;

/**
 * Class     PasswordResetsPolicy
 *
 * @package  Arcanesoft\Auth\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PasswordResetsPolicy extends AbstractPolicy
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
    protected $prefix = 'admin::auth.password-resets.';

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

            // admin::auth.password-resets.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'List all the password resets',
                'description' => 'Ability to list all the password resets',
            ]),

            // admin::auth.password-resets.metrics
            $this->makeAbility('metrics')->setMetas([
                'name'        => "List all the password resets' metrics",
                'description' => "Ability to list all the password resets' metrics",
            ]),

            // admin::auth.password-resets.delete
            $this->makeAbility('delete')->setMetas([
                'name'        => 'Delete a password reset',
                'description' => 'Ability to delete a password reset',
            ]),
            
        ];
    }

    /* -----------------------------------------------------------------
     |  Abilities
     | -----------------------------------------------------------------
     */

    /**
     * Allow to list all the password resets.
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
     * Allow to access the password resets' metrics.
     *
     * @param  \App\Models\User|mixed  $user
     *
     * @return bool|void
     */
    public function metrics(AuthenticatedUser $user)
    {
        //
    }

    /**
     * Allow to delete a password reset.
     *
     * @param  \App\Models\User|mixed  $user
     *
     * @return bool|void
     */
    public function delete(AuthenticatedUser $user)
    {
        //
    }
}
