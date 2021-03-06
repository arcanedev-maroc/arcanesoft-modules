<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Policies;

use Arcanesoft\Foundation\Auth\Models\User as AuthenticatedUser;

/**
 * Class     LogViewerPolicy
 *
 * @package  Arcanesoft\Foundation\System\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LogViewerPolicy extends AbstractPolicy
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
        return 'admin::system.log-viewer.';
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
            'category' => 'Log Viewer',
        ]);

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
     * @param  \Arcanesoft\Foundation\Auth\Models\User|mixed  $user
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function index(AuthenticatedUser $user)
    {
        //
    }

    /**
     * Allow to access the log details.
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
     * Allow to download the log files.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User|mixed  $user
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function download(AuthenticatedUser $user)
    {
        //
    }

    /**
     * Allow to delete the log files.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User|mixed  $user
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function delete(AuthenticatedUser $user)
    {
        //
    }
}
