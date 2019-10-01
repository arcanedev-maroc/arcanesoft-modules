<?php

namespace Arcanesoft\Blog;

use Arcanesoft\Support\Providers\PackageServiceProvider;

/**
 * Class     BlogServiceProvider
 *
 * @package  Arcanesoft\Blog
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class BlogServiceProvider extends PackageServiceProvider
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
    protected $package = 'blog';

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
//            Providers\ViewServiceProvider::class,
            Providers\MetricServiceProvider::class,
        ]);

        $this->registerCommands([
            Console\InstallCommand::class,
        ]);
    }

    /**
     * Boot the service provider.
     */
    public function boot()
    {
        $this->publishMultipleConfig();
        $this->publishViews();
        $this->publishTranslations();

        Blog::$runsMigrations ? $this->loadMigrations() : $this->publishMigrations();
    }
}
