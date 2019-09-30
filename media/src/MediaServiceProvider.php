<?php namespace Arcanesoft\Media;

use Arcanesoft\Support\PackageServiceProvider;

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
     *
     * @return void
     */
    public function register()
    {
        $this->registerMultipleConfig();

        $this->registerProviders([
            Providers\AuthServiceProvider::class,
            Providers\RouteServiceProvider::class,
        ]);

        $this->commands([
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
     *
     * @return void
     */
    public function boot()
    {
        $this->publishConfig(true);
        $this->publishViews();
        $this->publishTranslations();
    }
}
