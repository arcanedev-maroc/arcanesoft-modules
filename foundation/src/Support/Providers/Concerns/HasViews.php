<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Support\Providers\Concerns;

/**
 * Trait     HasViews
 *
 * @package  Arcanesoft\Foundation\Support\Providers\Concerns
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
        return $this->app['config']['view.paths'][0].DS.'vendor'.DS.$this->packageName();
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Publish the views files.
     */
    protected function publishViews(): void
    {
        $this->publishes([
            $this->viewsPath() => $this->viewsDestinationPath(),
        ], $this->getPublishTag('views'));
    }

    /**
     * Load the views files.
     */
    protected function loadViews(): void
    {
        $this->loadViewsFrom($this->viewsPath(), $this->packageName());
    }
}