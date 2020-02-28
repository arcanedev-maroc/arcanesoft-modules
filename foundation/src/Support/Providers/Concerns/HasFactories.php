<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Support\Providers\Concerns;

/**
 * Trait     HasFactories
 *
 * @package  Arcanesoft\Foundation\Support\Providers\Concerns
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait HasFactories
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the factories folder's path.
     *
     * @return string
     */
    protected function factoriesPath(): string
    {
        return $this->getBasePath('database/factories');
    }

    /**
     * Get the factories destination path.
     *
     * @return string
     */
    protected function factoriesDestinationPath(): string
    {
        return database_path('factories');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Load the factories.
     */
    protected function loadFactories(): void
    {
        $this->loadFactoriesFrom($this->factoriesPath());
    }

    /**
     * Publish the factories.
     */
    protected function publishFactories(): void
    {
        $this->publishes([
            $this->factoriesPath() => $this->factoriesDestinationPath(),
        ], $this->getPublishTag('factories'));
    }
}