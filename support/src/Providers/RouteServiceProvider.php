<?php namespace Arcanesoft\Support\Providers;

use Arcanesoft\Support\Concerns\HasRouteClasses;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

/**
 * Class     RouteServiceProvider
 *
 * @package  Arcanesoft\Support\Providers
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
     * Get the routes.
     *
     * @return array
     */
    public function routes(): array
    {
        return [
            //
        ];
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        static::bindRoutes($this->routes());

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        static::mapRoutes($this->routes());

        //
    }
}
