<?php namespace Arcanesoft\Auth\Http\Routes;

use Arcanesoft\Auth\Auth;
use Arcanesoft\Auth\Http\Controllers\PermissionsController;
use Arcanesoft\Auth\Http\Controllers\Datatables\PermissionsController as PermissionsDataTableController;
use Arcanesoft\Auth\Base\RouteRegistrar;
use Arcanesoft\Auth\Models\Permission;

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
     *
     * @return void
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
     *
     * @return void
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
     *
     * @return void
     */
    public function bindings(): void
    {
        $this->bind(self::PERMISSION_WILDCARD, function ($uuid) {
            return Auth::makeModel('permission')
                ->newQuery()
                ->where('uuid', '=', $uuid)
                ->firstOrFail();
        });
    }
}
