<?php

declare(strict_types=1);

namespace Arcanesoft\Backups;

use Arcanesoft\Backups\Console\{InstallCommand, PublishCommand};
use Arcanesoft\Foundation\Support\Providers\PackageServiceProvider;

/**
 * Class     BackupsServiceProvider
 *
 * @package  Arcanesoft\Backups
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class BackupsServiceProvider extends PackageServiceProvider
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
    protected $package = 'backups';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->registerMultipleConfig();

        $this->registerProviders([
            Providers\AuthServiceProvider::class,
            Providers\RouteServiceProvider::class,
        ]);

        $this->registerCommands([
            InstallCommand::class,
            PublishCommand::class,
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
        }
    }
}
