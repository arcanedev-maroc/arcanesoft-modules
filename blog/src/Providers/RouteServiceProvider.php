<?php namespace Arcanesoft\Blog\Providers;

use Arcanesoft\Blog\Http\Routes;
use Arcanesoft\Support\Providers\RouteServiceProvider as ServiceProvider;

/**
 * Class     RouteServiceProvider
 *
 * @package  Arcanesoft\Auth\Providers
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
            Routes\DashboardRoutes::class,
            Routes\PostsRoutes::class,
            Routes\TagsRoutes::class,
            Routes\AuthorsRoutes::class,
        ];
    }
}
