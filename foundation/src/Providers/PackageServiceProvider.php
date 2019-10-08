<?php

namespace Arcanesoft\Foundation\Providers;

use Arcanedev\LaravelMetrics\Metrics\Metric;
use Arcanesoft\Support\Providers\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

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
     */
    public function register(): void
    {
        parent::register();

        $this->registerModulesServiceProviders();

        $this->app->booting(function (Application $app) {
            static::changeLogViewerSettings($app);
            static::changeRouteViewerSettings($app);
        });
    }

    /**
     * Boot the service provider.
     */
    public function boot(): void
    {
        $this->extendMetricMacros();
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the modules service providers.
     */
    private function registerModulesServiceProviders(): void
    {
        $this->registerProviders(
            $this->app['config']->get('arcanesoft.foundation.modules.providers', [])
        );
    }

    /**
     * Change the log-viewer settings.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     */
    private static function changeLogViewerSettings(Application $app): void
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

    /**
     * Extend classes with macros.
     */
    private function extendMetricMacros(): void
    {
        Metric::macro('authorizedToSee', function (Request $request): bool {
            return method_exists($this, 'authorize')
                ? $this->authorize($request) === true
                : true;
        });
    }
}
