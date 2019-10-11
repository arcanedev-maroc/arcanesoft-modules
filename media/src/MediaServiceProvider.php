<?php

declare(strict_types=1);

namespace Arcanesoft\Media;

use Arcanesoft\Foundation\Support\Providers\PackageServiceProvider;

/**
 * Class     MediaServiceProvider
 *
 * @package  Arcanesoft\Media
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MediaServiceProvider extends PackageServiceProvider
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
    protected $package = 'media';

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

        $this->app->booting(function ($app) {
            /** @var  \Illuminate\Contracts\Config\Repository  $config */
            $config = $app['config'];

            $config->set('filesystems.disks', array_merge(
                $config->get('arcanesoft.media.filesystems.disks', []),
                $config->get('filesystems.disks', [])
            ));
        });
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
