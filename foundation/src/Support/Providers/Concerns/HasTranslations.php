<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Support\Providers\Concerns;

/**
 * Trait     HasTranslations
 *
 * @package  Arcanesoft\Foundation\Support\Providers\Concerns
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait HasTranslations
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the translations folder's path.
     *
     * @return string
     */
    protected function translationsPath(): string
    {
        return $this->getBasePath('translations');
    }

    /**
     * Get the translations destination path.
     *
     * @return string
     */
    protected function translationsDestinationPath(): string
    {
        return $this->app['path.lang'].DS.'vendor'.DS.$this->packageName();
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Publish and load the translations if $load argument is true.
     *
     * @param  bool  $load
     */
    protected function publishTranslations(): void
    {
        $this->publishes(
            [$this->translationsPath() => $this->translationsDestinationPath()],
            $this->getPublishTag('translations')
        );
    }

    /**
     * Load the translations files.
     */
    protected function loadTranslations(): void
    {
        $this->loadTranslationsFrom($this->translationsPath(), $this->packageName());
        $this->loadJsonTranslationsFrom($this->translationsPath());
    }
}