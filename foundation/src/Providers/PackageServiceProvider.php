<?php namespace Arcanesoft\Foundation\Providers;

use Arcanedev\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

/**
 * Class     PackageServiceProvider
 *
 * @package  Arcanesoft\Foundation\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PackageServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        $this->registerModulesServiceProviders();

        $this->app->booting(function ($app) {
            static::changeLogViewerSettings($app);
            static::changeRouteViewerSettings($app);
        });
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the modules service providers.
     *
     * @return void
     */
    protected function registerModulesServiceProviders(): void
    {
        $this->registerProviders(
            $this->config()->get('arcanesoft.foundation.modules.providers', [])
        );
    }

    /**
     * Change the log-viewer settings.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     */
    protected static function changeLogViewerSettings(Application $app): void
    {
        $app['config']->set('log-viewer.route.enabled', false);
        $app['config']->set('log-viewer.menu.filter-route', 'admin::foundation.system.log-viewer.logs.filter');
    }

    /**
     * Change the route-viewer settings.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     */
    protected static function changeRouteViewerSettings(Application $app)
    {
        $app['config']->set('route-viewer.route.enabled', false);
    }
}
