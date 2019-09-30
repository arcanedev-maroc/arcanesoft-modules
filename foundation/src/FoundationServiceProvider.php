<?php namespace Arcanesoft\Foundation;

use Arcanesoft\Support\PackageServiceProvider;

/**
 * Class     FoundationServiceProvider
 *
 * @package  Arcanesoft\Foundation
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class FoundationServiceProvider extends PackageServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Package name.
     *
     * @var string
     */
    protected $package = 'foundation';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig(true);

        $this->registerProviders([
            Providers\PackageServiceProvider::class,
            Providers\AuthServiceProvider::class,
            Providers\EventServiceProvider::class,
            Providers\RouteServiceProvider::class,
            Providers\ViewServiceProvider::class,
        ]);

        $this->registerCommands([
            Console\InstallCommand::class,
        ]);
    }

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishConfig(true);
        $this->publishViews();
        $this->publishTranslations();

        Foundation::$runsMigrations ? $this->loadMigrations() : $this->publishMigrations();
    }
}
