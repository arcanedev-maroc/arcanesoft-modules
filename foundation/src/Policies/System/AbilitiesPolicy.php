<?php

namespace Arcanesoft\Foundation\Policies\System;

use App\Models\User as AuthenticatedUser;
use Arcanedev\LaravelPolicies\Ability;
use Arcanesoft\Foundation\Core\Auth\Policy;

/**
 * Class     AbilitiesPolicy
 *
 * @package  Arcanesoft\Foundation\Policies\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AbilitiesPolicy extends Policy
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
        return 'admin::foundation.system.abilities.';
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the abilities.
     *
     * @return array
     */
    public function abilities(): iterable
    {
        $this->setMetas([
            'category' => 'System - Abilities',
        ]);

        return [

            // admin::foundation.system.abilities.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'List all the abilities',
                'description' => 'Allows to list all the abilities',
            ]),

            // admin::foundation.system.abilities.show
            $this->makeAbility('show')->setMetas([
                'name'        => 'Show the ability\'s details',
                'description' => 'Allows to show the ability\'s details',
            ]),

        ];
    }

    /* -----------------------------------------------------------------
    |  Policies
    | -----------------------------------------------------------------
    */

    /**
     * Allow to access all the abilities.
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
     * Allow to access all the abilities.
     *
     * @param  \App\Models\User                         $user
     * @param  \Arcanedev\LaravelPolicies\Ability|null  $ability
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function show(AuthenticatedUser $user, Ability $ability = null)
    {
        //
    }
}