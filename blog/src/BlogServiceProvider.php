<?php namespace Arcanesoft\Blog;

use Arcanesoft\Support\PackageServiceProvider;

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
//            Providers\ViewServiceProvider::class,
            Providers\MetricServiceProvider::class,
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

        Blog::$runsMigrations ? $this->loadMigrations() : $this->publishMigrations();
    }
}
