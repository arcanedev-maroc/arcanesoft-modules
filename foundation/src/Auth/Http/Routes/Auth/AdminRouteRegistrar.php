<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Routes\Auth;

use Arcanesoft\Foundation\Support\Http\AdminRouteRegistrar as RouteRegistrar;

/**
 * Class     AdminRouteRegistrar
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Routes\Auth
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class AdminRouteRegistrar extends RouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the admin middleware.
     *
     * @return array
     */
    protected function getAdminMiddleware(): array
    {
        return ['web'];
    }
}
