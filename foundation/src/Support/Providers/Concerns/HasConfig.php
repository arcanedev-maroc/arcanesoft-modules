<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Support\Providers\Concerns;

use Illuminate\Support\Collection;

/**
 * Trait     HasConfig
 *
 * @package  Arcanesoft\Foundation\Support\Providers\Concerns
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
        return $this->configPath("{$this->packageName()}.php");
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
        $this->mergeConfigFrom($this->configFilePath(), $this->packageName());
    }

    /**
     * Publish the config file.
     */
    protected function publishConfig(): void
    {
        $this->publishes([
            $this->configFilePath() => config_path("{$this->packageName()}.php")
        ], $this->getPublishTag('config'));
    }

    /**
     * Register multiple config files.
     *
     * @param  string  $separator
     */
    protected function registerMultipleConfig(string $separator = '.'): void
    {
        foreach ($this->configFilesPaths() as $configPath) {
            $this->mergeConfigFrom(
                $configPath, $this->vendor.$separator.$this->packageName().$separator.basename($configPath, '.php')
            );
        }
    }

    /**
     * Publish multiple config files.
     */
    protected function publishMultipleConfig(): void
    {
        $files = Collection::make($this->configFilesPaths())
            ->mapWithKeys(function ($file) {
                return [$file => config_path($this->vendor.DS.$this->packageName().DS.basename($file))];
            })
            ->toArray();

        $this->publishes($files, $this->getPublishTag('config'));
    }
}