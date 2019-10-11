<?php

declare(strict_types=1);

namespace Arcanesoft\Blog\Providers;

use Arcanesoft\Blog\Http\Routes;
use Arcanesoft\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

/**
 * Class     RouteServiceProvider
 *
 * @package  Arcanesoft\Auth\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RouteServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The routes list.
     *
     * @var array
     */
    protected $routeClasses = [
        Routes\DashboardRoutes::class,
        Routes\PostsRoutes::class,
        Routes\TagsRoutes::class,
        Routes\AuthorsRoutes::class,
    ];
}
