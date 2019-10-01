<?php

namespace Arcanesoft\Auth;

use Arcanesoft\Auth\Console\{InstallCommand, MakeUser};
use Arcanesoft\Support\Providers\PackageServiceProvider;

/**
 * Class     AuthServiceProvider
 *
 * @package  Arcanesoft\Auth
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AuthServiceProvider extends PackageServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The package name.
     *
     * @var  string
     */
    protected $package = 'auth';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerMultipleConfig();

        $this->registerProviders([
            Providers\AuthServiceProvider::class,
            Providers\EventServiceProvider::class,
            Providers\RouteServiceProvider::class,
            Providers\ViewServiceProvider::class,
            Providers\MetricServiceProvider::class,
        ]);

        $this->registerCommands([
            MakeUser::class,
        ]);
    }

    /**
     * Boot the service provider.
     */
    public function boot(): void
    {
        $this->publishMultipleConfig();
        $this->publishViews();
        $this->publishTranslations();

        Auth::$runsMigrations ? $this->loadMigrations() : $this->publishMigrations();
    }
}
