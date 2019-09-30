<?php namespace Arcanesoft\Support;

use Exception;
use Illuminate\Contracts\Foundation\Application;
use ReflectionClass;

/**
 * Class     PackageServiceProvider
 *
 * @package  Arcanesoft\Support
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class PackageServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The vendor name.
     *
     * @var  string
     */
    protected $vendor = 'arcanesoft';

    /**
     * The package name.
     *
     * @var  string|null
     */
    protected $package;

    /**
     * The package root path.
     *
     * @var  string
     */
    protected $rootPath;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Create a new service provider instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     */
    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->rootPath = dirname(
            (new ReflectionClass($this))->getFileName(), 2
        );
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the factories folder's path.
     *
     * @return string
     */
    protected function getFactoriesPath(): string
    {
        return "{$this->rootPath}/database/factories";
    }

    /**
     * Get the migration folder's path.
     *
     * @return string
     */
    protected function getMigrationsPath(): string
    {
        return "{$this->rootPath}/database/migrations";
    }

    /**
     * Get the translations folder's path.
     *
     * @return string
     */
    protected function getTranslationsPath(): string
    {
        return realpath("{$this->rootPath}/resources/lang");
    }

    /**
     * Get the views folder's path.
     *
     * @return string
     */
    protected function getViewsPath(): string
    {
        return "{$this->rootPath}/resources/views";
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register providers.
     *
     * @param  array  $providers
     *
     * @return void
     */
    protected function registerProviders(array $providers): void
    {
        foreach ($providers as $provider) {
            $this->app->register($provider);
        }
    }

    /**
     * Register the commands.
     *
     * @param  array  $commands
     *
     * @return void
     */
    protected function registerCommands(array $commands)
    {
        if ($this->app->runningInConsole()) {
            $this->commands($commands);
        }
    }

    /**
     * Register multiple config files.
     *
     * @param  string  $separator
     *
     * @return void
     */
    protected function registerMultipleConfig(string $separator = '.'): void
    {
        $this->registerConfig(true, $separator);
    }

    /**
     * Register the config file(s).
     *
     * @param  bool    $multiple
     * @param  string  $separator
     *
     * @return void
     */
    protected function registerConfig(bool $multiple = false, string $separator = '.'): void
    {
        $this->checkPackageName();

        if ($multiple) {
            foreach ($this->getConfigFiles() as $configPath) {
                $this->mergeConfigFrom(
                    $configPath, $this->vendor.$separator.$this->package.$separator.basename($configPath, '.php')
                );
            }
        }
        else {
            $this->mergeConfigFrom($this->rootPath.DS.'config'.DS."{$this->package}.php", $this->package);
        }
    }

    /**
     * Publish the config file(s).
     *
     * @param  bool  $multiple
     *
     * @return void
     */
    protected function publishConfig(bool $multiple = false): void
    {
        $this->checkPackageName();

        $files = $multiple
            ? collect($this->getConfigFiles())
                ->mapWithKeys(function ($file) {
                    return [$file => config_path($this->vendor.DS.$this->package.DS.basename($file))];
                })
                ->toArray()
            : ["{$this->rootPath}/config/{$this->package}.php" => config_path("{$this->package}.php")];

        $this->publishes($files, "{$this->package}-config");
    }

    /**
     * Get the config files (paths).
     *
     * @return array|false
     */
    protected function getConfigFiles()
    {
        return glob("{$this->rootPath}/config/*.php");
    }

    /**
     * Publish and load the views if $load argument is true.
     *
     * @param  bool  $load
     *
     * @return void
     */
    protected function publishViews(bool $load = true): void
    {
        $this->checkPackageName();

        $this->publishes([
            $this->getViewsPath() => resource_path("views/vendor/{$this->package}"),
        ], "{$this->package}-views");

        if ($load)
            $this->loadViews();
    }

    /**
     * Load the views files.
     *
     * @return void
     */
    protected function loadViews(): void
    {
        $this->checkPackageName();

        $this->loadViewsFrom($this->getViewsPath(), $this->package);
    }

    /**
     * Publish and load the translations if $load argument is true.
     *
     * @param  bool  $load
     *
     * @return void
     */
    protected function publishTranslations(bool $load = true): void
    {
        $this->checkPackageName();

        $this->publishes(
            [$this->getTranslationsPath() => resource_path("lang/vendor/{$this->package}")],
            "{$this->package}-translations"
        );

        if ($load)
            $this->loadTranslations();
    }

    /**
     * Load the translations files.
     *
     * @return void
     */
    protected function loadTranslations(): void
    {
        $this->loadTranslationsFrom($this->getTranslationsPath(), $this->package);
        $this->loadJsonTranslationsFrom($this->getTranslationsPath());
    }

    /**
     * Publish the migration files.
     *
     * @return void
     */
    protected function publishMigrations(): void
    {
        $this->checkPackageName();

        $this->publishes(
            [$this->getMigrationsPath() => database_path('migrations')],
            "{$this->package}-migrations"
        );
    }

    /**
     * Load the migrations files.
     *
     * @return void
     */
    protected function loadMigrations(): void
    {
        $this->loadMigrationsFrom($this->getMigrationsPath());
    }

    /**
     * Publish the factories.
     *
     * @return void
     */
    protected function publishFactories(): void
    {
        $this->checkPackageName();

        $this->publishes(
            [$this->getFactoriesPath() => database_path('factories')],
            "{$this->package}-factories"
        );
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check the package name.
     *
     * @return void
     */
    private function checkPackageName(): void
    {
        if (empty($this->package)) {
            new Exception('The package name is required');
        }
    }
}
