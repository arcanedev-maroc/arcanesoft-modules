<?php

declare(strict_types=1);

namespace Arcanesoft\Seo;

use Arcanesoft\Foundation\Support\Providers\PackageServiceProvider;

/**
 * Class     SeoServiceProvider
 *
 * @package  Arcanesoft\Seo
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoServiceProvider extends PackageServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The package name.
     *
     * @var string
     */
    protected $package = 'seo';

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
            Providers\RouteServiceProvider::class,
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
            $this->publishViews();
            $this->publishTranslations();
            $this->publishAssets();
        }
    }
}
