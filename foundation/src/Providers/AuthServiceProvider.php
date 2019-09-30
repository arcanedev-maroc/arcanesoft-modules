<?php namespace Arcanesoft\Foundation\Providers;

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
     *
     * @return void
     */
    public function boot()
    {
        $this->registerDefinitions(
            array_keys(config()->get('arcanesoft.foundation.policies', []))
        );
    }
}
