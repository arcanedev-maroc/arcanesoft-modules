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
     |  Policies
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

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the policy's prefix.
     *
     * @return string
     */
    public static function prefix(): string
    {
        return 'admin::auth.password-resets';
    }

    /**
     * Get the policy metas.
     *
     * @return array
     */
    public static function metas(): array
    {
        return [
            static::meta('index') // admin::auth.password-resets.index
                  ->name('List all the password resets')
                  ->description('Ability to list all the password resets'),

            static::meta('metrics') // admin::auth.password-resets.metrics
                  ->name("List all the password resets' metrics")
                  ->description("Ability to list all the password resets' metrics"),

            static::meta('delete') // admin::auth.password-resets.delete
                  ->name('Delete a password reset')
                  ->description('Ability to delete a password reset'),
        ];
    }
}
