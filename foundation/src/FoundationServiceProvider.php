<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation;

use Arcanesoft\Foundation\Support\Providers\PackageServiceProvider;

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
     */
    public function register(): void
    {
        $this->registerMultipleConfig();

        $this->registerProviders([
            // Foundation's Modules
            Auth\AuthServiceProvider::class,
            Core\CoreServiceProvider::class,
            System\SystemServiceProvider::class,
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

            Foundation::$runsMigrations ? $this->loadMigrations() : $this->publishMigrations();
        }
    }
}
