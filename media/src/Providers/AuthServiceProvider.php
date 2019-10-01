<?php

namespace Arcanesoft\Media\Providers;

use Arcanesoft\Support\Providers\AuthServiceProvider as ServiceProvider;

/**
 * Class     AuthServiceProvider
 *
 * @package  Arcanesoft\Media\Providers
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
        $policies = $this->app->get('config')->get('arcanesoft.media.policies', []);

        $this->registerDefinitions($policies);
    }
}
