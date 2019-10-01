<?php

namespace Arcanesoft\Support\Providers\Concerns;

/**
 * Trait     HasMigrations
 *
 * @package  Arcanesoft\Support\Providers\Concerns
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait HasMigrations
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the migration folder's path.
     *
     * @return string
     */
    protected function migrationsPath(): string
    {
        return $this->getBasePath('database/migrations');
    }

    /**
     * Get the migration destination path.
     *
     * @return string
     */
    protected function migrationsDestinationPath(): string
    {
        return database_path('migrations');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Publish the migration files.
     */
    protected function publishMigrations(): void
    {
        $this->checkPackageName();

        $this->publishes([
            $this->migrationsPath() => $this->migrationsDestinationPath(),
        ], $this->getPublishTag('migrations'));
    }

    /**
     * Load the migrations files.
     */
    protected function loadMigrations(): void
    {
        $this->loadMigrationsFrom($this->migrationsPath());
    }
}