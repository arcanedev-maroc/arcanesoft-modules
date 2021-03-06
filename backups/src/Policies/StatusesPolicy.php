<?php

namespace Arcanesoft\Backups\Policies;

use Arcanesoft\Foundation\Auth\Models\User as AuthenticatedUser;
use Arcanesoft\Foundation\Support\Auth\Policy;

/**
 * Class     StatusesPolicy
 *
 * @package  Arcanesoft\Backups\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class StatusesPolicy extends Policy
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
        return 'admin::backups.statuses.';
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
            'category' => 'Statuses',
        ]);

        return [

            // admin::backups.statuses.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'Show all backup statuses',
                'description' => 'Ability to list all backup statuses',
            ]),

            // admin::backups.statuses.show
            $this->makeAbility('show')->setMetas([
                'name'        => 'Show a backup status',
                'description' => 'Ability to show a backup status',
            ]),

            // admin::backups.statuses.create
            $this->makeAbility('create')->setMetas([
                'name'        => 'Create a backup',
                'description' => 'Ability to create a backup',
            ]),

            // admin::backups.statuses.clean
            $this->makeAbility('clean')->setMetas([
                'name'        => 'Clean backups',
                'description' => 'Ability to clean old backups',
            ]),

        ];
    }

    /* -----------------------------------------------------------------
     |  Abilities
     | -----------------------------------------------------------------
     */

    /**
     * Allow to list all the backups.
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
     * Allow to display a backup.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User|mixed  $user
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function show(AuthenticatedUser $user)
    {
        //
    }

    /**
     * Allow to create a backup.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User|mixed  $user
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function create(AuthenticatedUser $user)
    {
        //
    }

    /**
     * Allow to clean backups.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User|mixed  $user
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function clean(AuthenticatedUser $user)
    {
        //
    }
}
