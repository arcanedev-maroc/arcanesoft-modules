<?php

namespace Arcanesoft\Backups\Providers;

use Arcanesoft\Backups\Policies\StatusesPolicy;
use Arcanesoft\Support\Providers\AuthServiceProvider as ServiceProvider;

/**
 * Class     AuthorizationServiceProvider
 *
 * @package  Arcanesoft\Backups\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AuthServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register any application authentication / authorization services.
     */
    public function boot(): void
    {
        parent::registerPolicies();

        $policies = $this->app->get('config')->get('arcanesoft.backups.policies', []);

        $this->registerDefinitions($policies);
    }
}
