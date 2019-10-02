<?php

namespace Arcanesoft\Support\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

/**
 * Class     AuthServiceProvider
 *
 * @package  Arcanesoft\Support\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class AuthServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the policy's definitions.
     *
     * @param  \Arcanesoft\Support\Policies\Policy[]|array  $policies
     */
    protected function registerDefinitions(array $policies)
    {
        foreach ($policies as $class) {
            foreach ($this->app->call("{$class}@abilities") as $ability) {
                /** @var  \Arcanesoft\Support\Policies\Ability  $ability */
                Gate::define($ability->key(), $ability->method());
            }
        }
    }

    /**
     * Register the policy's definitions.
     *
     * @param  \Arcanesoft\Support\Policies\Policy[]  $resources
     */
    protected function registerResources(array $resources)
    {
        foreach ($resources as $class) {
            /** @var  \Arcanesoft\Support\Policies\Policy  $class */
            Gate::resource($class::prefix(), $class, $class::abilities());
        }
    }
}
