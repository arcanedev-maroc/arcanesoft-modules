<?php

namespace Arcanesoft\Backups\Policies;

use App\Models\User as AuthenticatedUser;

/**
 * Class     StatusesPolicy
 *
 * @package  Arcanesoft\Backups\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class StatusesPolicy extends AbstractPolicy
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
    protected $prefix = 'admin::backups.statuses.';

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
     * @param  \App\Models\User  $user
     *
     * @return bool|void
     */
    public function index(AuthenticatedUser $user)
    {
        //
    }

    /**
     * Allow to display a backup.
     *
     * @param  \App\Models\User  $user
     *
     * @return bool|void
     */
    public function show(AuthenticatedUser $user)
    {
        //
    }

    /**
     * Allow to create a backup.
     *
     * @param  \App\Models\User  $user
     *
     * @return bool|void
     */
    public function create(AuthenticatedUser $user)
    {
        //
    }

    /**
     * Allow to clean backups.
     *
     * @param  \App\Models\User  $user
     *
     * @return bool|void
     */
    public function clean(AuthenticatedUser $user)
    {
        //
    }
}
