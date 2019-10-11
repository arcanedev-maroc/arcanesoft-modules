<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Support\Providers;

use Arcanesoft\Foundation\Support\Http\Concerns\HasRouteClasses;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

/**
 * Class     RouteServiceProvider
 *
 * @package  Arcanesoft\Foundation\Support\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class RouteServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasRouteClasses;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The routes list.
     *
     * @var array
     */
    protected $routeClasses = [];

    /* -----------------------------------------------------------------
     |  Getters
     | -----------------------------------------------------------------
     */

    /**
     * Get the registered routes.
     *
     * @return array
     */
    public function routeClasses(): array
    {
        return $this->routeClasses;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void
    {
        static::bindRouteClasses($this->routeClasses());

        parent::boot();
    }

    /**
     * Define the routes for the application.
     */
    public function map(): void
    {
        static::mapRouteClasses($this->routeClasses());

        //
    }
}
