<?php

namespace Arcanesoft\Support\Providers\Concerns;

/**
 * Trait     HasTranslations
 *
 * @package  Arcanesoft\Support\Providers\Concerns
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
        return $this->app['path.lang'].DS.'vendor'.DS.$this->package;
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
    protected function publishTranslations(bool $load = true): void
    {
        $this->checkPackageName();

        $this->publishes(
            [$this->translationsPath() => $this->translationsDestinationPath()],
            $this->getPublishTag('translations')
        );

        if ($load)
            $this->loadTranslations();
    }

    /**
     * Load the translations files.
     */
    protected function loadTranslations(): void
    {
        $this->loadTranslationsFrom($this->translationsPath(), $this->package);
        $this->loadJsonTranslationsFrom($this->translationsPath());
    }
}