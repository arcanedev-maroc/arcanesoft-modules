<?php

declare(strict_types=1);

namespace Arcanesoft\Blog;

use Arcanesoft\Foundation\Support\Providers\PackageServiceProvider;

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
            Providers\MetricServiceProvider::class,
            Providers\RouteServiceProvider::class,
//            Providers\ViewServiceProvider::class,
        ]);

        $this->registerCommands([
            Console\InstallCommand::class,
        ]);
    }

    /**
     * Boot the service provider.
     */
    public function boot(): void
    {
        $this->loadViews();
        $this->loadTranslations();

        if ($this->app->runningInConsole()) {
            $this->publishMultipleConfig();
            $this->publishViews(false);
            $this->publishTranslations(false);

            Blog::$runsMigrations ? $this->loadMigrations() : $this->publishMigrations();
        }
    }
}
