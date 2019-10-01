<?php

namespace Arcanesoft\Support\Providers\Concerns;

/**
 * Trait     HasViews
 *
 * @package  Arcanesoft\Support\Providers\Concerns
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait HasViews
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the views folder's path.
     *
     * @return string
     */
    protected function viewsPath(): string
    {
        return $this->getBasePath('views');
    }

    /**
     * Get the views destination path.
     *
     * @return string
     */
    protected function viewsDestinationPath(): string
    {
        return $this->app['config']->get('view.paths.0').DS.'vendor'.DS.$this->package;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Publish and load the views if $load argument is true.
     *
     * @param  bool  $load
     */
    protected function publishViews(bool $load = true): void
    {
        $this->checkPackageName();

        $this->publishes([
            $this->viewsPath() => $this->viewsDestinationPath(),
        ], $this->getPublishTag('views'));

        if ($load)
            $this->loadViews();
    }

    /**
     * Load the views files.
     */
    protected function loadViews(): void
    {
        $this->checkPackageName();

        $this->loadViewsFrom($this->viewsPath(), $this->package);
    }
}