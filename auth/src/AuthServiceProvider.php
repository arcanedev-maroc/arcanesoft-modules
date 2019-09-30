<?php namespace Arcanesoft\Auth;

use Arcanesoft\Support\PackageServiceProvider;

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
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig(true);

        $this->registerProviders([
            Providers\AuthServiceProvider::class,
            Providers\EventServiceProvider::class,
            Providers\RouteServiceProvider::class,
            Providers\ViewServiceProvider::class,
            Providers\MetricServiceProvider::class,
        ]);

        $this->registerCommands([
            Console\InstallCommand::class,
            Console\MakeUser::class,
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

        Auth::$runsMigrations ? $this->loadMigrations() : $this->publishMigrations();
    }
}
