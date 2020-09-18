<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Authentication\Providers;

use Arcanesoft\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Arcanesoft\Foundation\Authentication\Http\Routes;

/**
 * Class     RouteServiceProvider
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RouteServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the registered routes.
     *
     * @return array
     */
    public function routeClasses(): array
    {
        return [
            Routes\AuthenticationRoutes::class,
        ];
    }
}