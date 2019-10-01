<?php

namespace Arcanesoft\Support\Providers\Concerns;

use Illuminate\Support\Collection;

/**
 * Trait     HasConfig
 *
 * @package  Arcanesoft\Support\Providers\Concerns
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait HasConfig
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the config folder path.
     *
     * @param  string  $path
     *
     * @return string
     */
    protected function configPath(string $path = ''): string
    {
        return $this->getBasePath(
            'config'.($path ? DIRECTORY_SEPARATOR.$path : $path)
        );
    }

    /**
     * Get the config file path.
     *
     * @return string
     */
    protected function configFilePath(): string
    {
        return $this->configPath("{$this->package}.php");
    }

    /**
     * Get the config files (paths).
     *
     * @return array|false
     */
    protected function configFilesPaths()
    {
        return glob($this->configPath('*.php'));
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the config file.
     */
    protected function registerConfig(): void
    {
        $this->checkPackageName();

        $this->mergeConfigFrom($this->configFilePath(), $this->package);
    }

    /**
     * Publish the config file.
     */
    protected function publishConfig(): void
    {
        $this->checkPackageName();

        $this->publishes([
            $this->configFilePath() => config_path("{$this->package}.php")
        ], $this->getPublishTag('config'));
    }

    /**
     * Register multiple config files.
     *
     * @param  string  $separator
     */
    protected function registerMultipleConfig(string $separator = '.'): void
    {
        $this->checkPackageName();

        foreach ($this->configFilesPaths() as $configPath) {
            $this->mergeConfigFrom(
                $configPath, $this->vendor.$separator.$this->package.$separator.basename($configPath, '.php')
            );
        }
    }

    /**
     * Publish multiple config files.
     */
    protected function publishMultipleConfig(): void
    {
        $this->checkPackageName();

        $files = Collection::make($this->configFilesPaths())
            ->mapWithKeys(function ($file) {
                return [$file => config_path($this->vendor.DS.$this->package.DS.basename($file))];
            })
            ->toArray();

        $this->publishes($files, $this->getPublishTag('config'));
    }
}