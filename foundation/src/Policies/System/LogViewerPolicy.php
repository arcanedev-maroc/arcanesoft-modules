<?php namespace Arcanesoft\Foundation\Policies\System;

use App\Models\User as AuthenticatedUser;
use Arcanesoft\Support\Policies\Policy;

/**
 * Class     LogViewerPolicy
 *
 * @package  Arcanesoft\Foundation\Policies\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LogViewerPolicy extends Policy
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
        return 'admin::foundation.system.log-viewer';
    }

    /**
     * Get the policy metas.
     *
     * @return array
     */
    public static function metas(): array
    {
        return [
            static::meta('index') // admin::foundation.system.log-viewer.index
                  ->name('Show all the logs & metrics')
                  ->description('Ability to show all the logs & metrics'),

            static::meta('show') // admin::foundation.system.log-viewer.show
                  ->name('Show the log details')
                  ->description('Ability to show the log details'),

            static::meta('download') // admin::foundation.system.log-viewer.download
                  ->name('Download the log files')
                  ->description('Ability to download the log files'),

            static::meta('delete') // admin::foundation.system.log-viewer.delete
                  ->name('Delete the log files')
                  ->description('Ability to delete the log files'),
        ];
    }

    /* -----------------------------------------------------------------
     |  Policies
     | -----------------------------------------------------------------
     */

    /**
     * Allow to access all the logs & metrics.
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
     * Allow to access the log details.
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
     * Allow to download the log files.
     *
     * @param  \App\Models\User  $user
     *
     * @return bool|void
     */
    public function download(AuthenticatedUser $user)
    {
        //
    }

    /**
     * Allow to delete the log files.
     *
     * @param  \App\Models\User  $user
     *
     * @return bool|void
     */
    public function delete(AuthenticatedUser $user)
    {
        //
    }
}
