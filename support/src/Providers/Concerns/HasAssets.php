<?php

namespace Arcanesoft\Support\Providers\Concerns;

/**
 * Trait     HasAssets
 *
 * @package  Arcanesoft\Support\Providers\Concerns
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait HasAssets
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the assets path.
     *
     * @return string
     */
    protected function assetsPath(): string
    {
        return $this->getBasePath('assets');
    }

    /**
     * Get the assets destination path.
     *
     * @return string
     */
    protected function assetsDestinationPath(): string
    {
        return base_path('assets'.DS.$this->packageName());
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Publish the assets.
     */
    protected function publishAssets(): void
    {
        $this->publishes(
            [$this->assetsPath() => $this->assetsDestinationPath()],
            $this->getPublishTag('assets')
        );
    }
}