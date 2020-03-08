<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation;

use Arcanesoft\Foundation\Auth\AuthServiceProvider;
use Arcanesoft\Foundation\Core\CoreServiceProvider;
use Arcanesoft\Foundation\Support\Providers\PackageServiceProvider;
use Arcanesoft\Foundation\System\SystemServiceProvider;

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

    /**
     * Merge multiple config files into one instance (package name as root key).
     *
     * @var bool
     */
    protected $multiConfigs = true;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerConfig();

        $this->registerProviders([
            // Foundation's Modules
            CoreServiceProvider::class,
            AuthServiceProvider::class,
            SystemServiceProvider::class,
        ]);
    }

    /**
     * Boot the service provider.
     */
    public function boot(): void
    {
        $this->loadTranslations();
        $this->loadViews();

        if ($this->app->runningUnitTests()) {
            $this->loadFactories();
        }

        if ($this->app->runningInConsole()) {
            $this->publishAssets();
            $this->publishConfig();
            $this->publishFactories();
            $this->publishTranslations();
            $this->publishViews();

            Foundation::$runsMigrations
                ? $this->loadMigrations()
                : $this->publishMigrations();
        }
    }
}
