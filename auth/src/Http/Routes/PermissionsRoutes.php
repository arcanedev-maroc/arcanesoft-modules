<?php

namespace Arcanesoft\Auth\Http\Routes;

use Arcanesoft\Auth\Http\Controllers\Datatables\PermissionsController as PermissionsDataTableController;
use Arcanesoft\Auth\Http\Controllers\PermissionsController;
use Arcanesoft\Auth\Repositories\PermissionsRepository;

/**
 * Class     PermissionsRoutes
 *
 * @package  Arcanesoft\Auth\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PermissionsRoutes extends RouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const PERMISSION_WILDCARD = 'admin_auth_permission';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Map the routes.
     */
    public function map(): void
    {
        $this->adminGroup(function () {
            $this->prefix('permissions')->name('permissions.')->group(function () {
                $this->get('/', [PermissionsController::class, 'index'])
                     ->name('index'); //  admin::auth.permissions.index

                $this->mapDataTableRoutes();

                $this->prefix('{'.self::PERMISSION_WILDCARD.'}')->group(function () {
                    $this->get('/', [PermissionsController::class, 'show'])
                         ->name('show'); // admin::auth.permissions.show
                });
            });
        });
    }

    /**
     * Map datatable routes.
     */
    protected function mapDataTableRoutes(): void
    {
        $this->dataTableGroup(function () {
            $this->get('/', [PermissionsDataTableController::class, 'index'])
                 ->name('index'); //  admin::auth.permissions.datatables.index
        });
    }

    /**
     * Register the route bindings.
     */
    public function bindings(): void
    {
        $this->bind(self::PERMISSION_WILDCARD, function (PermissionsRepository $repo, string $uuid) {
            return $repo->query()
                ->where('uuid', '=', $uuid)
                ->firstOrFail();
        });
    }
}
