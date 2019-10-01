<?php

namespace Arcanesoft\Backups;

use Arcanesoft\Backups\Console\{InstallCommand, PublishCommand};
use Arcanesoft\Support\Providers\PackageServiceProvider;

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
        parent::register();

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
        $this->publishMultipleConfig();
        $this->publishViews();
        $this->publishTranslations();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            //
        ];
    }
}
