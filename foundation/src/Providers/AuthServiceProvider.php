<?php

namespace Arcanesoft\Foundation\Providers;

use Arcanesoft\Support\Providers\AuthServiceProvider as ServiceProvider;

/**
 * Class     AuthServiceProvider
 *
 * @package  Arcanesoft\Foundation\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AuthServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $policies = $this->app->get('config')->get('arcanesoft.foundation.policies', []);

        $this->registerDefinitions($policies);
    }
}
