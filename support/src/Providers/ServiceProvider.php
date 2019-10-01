<?php namespace Arcanesoft\Support\Providers;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

/**
 * Class     ServiceProvider
 *
 * @package  Arcanesoft\Support\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class ServiceProvider extends IlluminateServiceProvider
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register a shared binding in the container.
     *
     * @param  string                $abstract
     * @param  \Closure|string|null  $concrete
     */
    public function singleton(string $abstract, $concrete = null): void
    {
        $this->app->singleton($abstract, $concrete);
    }

    /**
     * Register providers.
     *
     * @param  array  $providers
     */
    public function registerProviders(array $providers): void
    {
        foreach ($providers as $provider) {
            $this->app->register($provider);
        }
    }

    /**
     * Register the commands.
     *
     * @param  array  $commands
     */
    public function registerCommands(array $commands): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands($commands);
        }
    }
}
