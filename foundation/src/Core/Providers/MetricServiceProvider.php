<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Providers;

use Arcanedev\LaravelMetrics\Contracts\Manager;
use Illuminate\Support\ServiceProvider;

/**
 * Class     MetricServiceProvider
 *
 * @package  Arcanesoft\Foundation\Core\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class MetricServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The metrics.
     *
     * @var array
     */
    protected $metrics = [];

    /* -----------------------------------------------------------------
     |  Getters
     | -----------------------------------------------------------------
     */

    /**
     * Get the metrics.
     *
     * @return iterable
     */
    public function metrics(): iterable
    {
        return $this->metrics;
    }

    /**
     * Get the metrics manager instance.
     *
     * @return \Arcanedev\LaravelMetrics\Contracts\Manager
     */
    public function getMetricsManager(): Manager
    {
        return $this->app->make(Manager::class);
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register bindings in the container.
     */
    public function boot(): void
    {
        $manager = $this->getMetricsManager();

        foreach ($this->metrics() as $metric) {
            $manager->register($metric);
        }
    }
}