<?php namespace Arcanesoft\Foundation\Policies\System;

use App\Models\User as AuthenticatedUser;
use Arcanesoft\Foundation\Policies\AbstractPolicy;

/**
 * Class     LogViewerPolicy
 *
 * @package  Arcanesoft\Foundation\Policies\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LogViewerPolicy extends AbstractPolicy
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
    protected $prefix = 'admin::foundation.system.log-viewer.';

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

            // admin::foundation.system.log-viewer.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'Show all the logs & metrics',
                'description' => 'Ability to show all the logs & metrics',
            ]),

            // admin::foundation.system.log-viewer.show
            $this->makeAbility('show')->setMetas([
                'name'        => 'Show the log details',
                'description' => 'Ability to show the log details',
            ]),

            // admin::foundation.system.log-viewer.download
            $this->makeAbility('download')->setMetas([
                'name'        => 'Download the log files',
                'description' => 'Ability to download the log files',
            ]),

            // admin::foundation.system.log-viewer.delete
            $this->makeAbility('delete')->setMetas([
                'name'        => 'Delete the log files',
                'description' => 'Ability to delete the log files',
            ]),

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
