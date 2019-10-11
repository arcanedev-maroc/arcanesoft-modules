<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Policies;

use Arcanesoft\Foundation\Auth\Models\User as AuthenticatedUser;
use Arcanedev\LaravelPolicies\Ability;

/**
 * Class     AbilitiesPolicy
 *
 * @package  Arcanesoft\Foundation\System\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AbilitiesPolicy extends AbstractPolicy
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
        return 'admin::system.abilities.';
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the abilities.
     *
     * @return \Arcanedev\LaravelPolicies\Ability[]|iterable
     */
    public function abilities(): iterable
    {
        $this->setMetas([
            'category' => 'System - Abilities',
        ]);

        return [

            // admin::system.abilities.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'List all the abilities',
                'description' => 'Allows to list all the abilities',
            ]),

            // admin::system.abilities.show
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
     * @param  \Arcanesoft\Foundation\Auth\Models\User|mixed  $user
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
     * @param  \Arcanesoft\Foundation\Auth\Models\User|mixed  $user
     * @param  \Arcanedev\LaravelPolicies\Ability|null        $ability
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function show(AuthenticatedUser $user, Ability $ability = null)
    {
        //
    }
}