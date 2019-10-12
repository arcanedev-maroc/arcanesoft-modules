<?php

namespace Arcanesoft\Foundation\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;

/**
 * Class     TestCase
 *
 * @package  Arcanesoft\Foundation\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class TestCase extends OrchestraTestCase
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            // Main Provider
            \Arcanesoft\Foundation\FoundationServiceProvider::class,

            // Dependencies
            \Arcanedev\LaravelImpersonator\ImpersonatorServiceProvider::class,
            \Arcanedev\LaravelPolicies\PoliciesServiceProvider::class,
            \Arcanedev\LaravelMetrics\MetricServiceProvider::class,
            \Arcanedev\Notify\NotifyServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getEnvironmentSetUp($app): void
    {
        // Configuration
        $app['config']->set(
            'arcanesoft.foundation.auth.database.models.user',
            Stubs\Models\User::class
        );
    }

    /**
     * Load the migrations.
     */
    protected function loadMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    /**
     * Load the factories.
     */
    protected function loadFactories(): void
    {
        $this->withFactories(__DIR__.'/../database/factories');
    }
}