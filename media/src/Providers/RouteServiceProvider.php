<?php namespace Arcanesoft\Media\Providers;

use Arcanesoft\Media\Http\Routes;
use Arcanesoft\Support\Providers\RouteServiceProvider as ServiceProvider;

/**
 * Class     RouteServiceProvider
 *
 * @package  Arcanesoft\Media\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RouteServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Main Methods
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
            Routes\MediaRoutes::class,
        ];
    }
}
