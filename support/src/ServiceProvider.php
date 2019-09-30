<?php namespace Arcanesoft\Support;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Class     ServiceProvider
 *
 * @package  Arcanesoft\Support
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class ServiceProvider extends BaseServiceProvider
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
     *
     * @return void
     */
    public function singleton($abstract, $concrete = null)
    {
        $this->app->singleton($abstract, $concrete);
    }
}
