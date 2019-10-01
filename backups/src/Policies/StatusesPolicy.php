<?php

namespace Arcanesoft\Backups\Policies;

use Arcanesoft\Support\Policies\Policy;
use App\Models\User as AuthenticatedUser;

/**
 * Class     StatusesPolicy
 *
 * @package  Arcanesoft\Backups\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class StatusesPolicy extends Policy
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the policy's prefix.
     *
     * @return string
     */
    public static function prefix(): string
    {
        return 'admin::backups.statuses';
    }

    /**
     * Get the policy metas.
     *
     * @return array
     */
    public static function metas(): array
    {
        return [
            static::meta('index') // admin::backups.statuses.index
                  ->name('Show all backup statuses')
                  ->description('Ability to list all backup statuses'),

            static::meta('show') // admin::backups.statuses.show
                  ->name('Show a backup status')
                  ->description('Ability to show a backup status'),

            static::meta('create') // admin::backups.statuses.create
                  ->name('Create a backup')
                  ->description('Ability to create a backup'),

            static::meta('clean') // admin::backups.statuses.clean
                  ->name('Clean backups')
                  ->description('Ability to clean old backups'),
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
