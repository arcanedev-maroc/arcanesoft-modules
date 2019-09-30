<?php namespace Arcanesoft\Support\Providers;

use Arcanedev\LaravelMetrics\Contracts\Manager;
use Illuminate\Support\ServiceProvider;

/**
 * Class     MetricServiceProvider
 *
 * @package  Arcanesoft\Support\Providers
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
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->metrics as $metric) {
            $this->app->make(Manager::class)->register($metric);
        }
    }
}
