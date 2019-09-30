<?php namespace Arcanesoft\Auth\Http\Routes;

use Arcanesoft\Auth\Auth;
use Arcanesoft\Auth\Http\Controllers\RolesController;
use Arcanesoft\Auth\Http\Controllers\Datatables\RolesController as RolesDataTablesController;
use Arcanesoft\Auth\Base\RouteRegistrar;
use Arcanesoft\Auth\Models\Role;

/**
 * Class     RolesRoutes
 *
 * @package  Arcanesoft\Auth\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RolesRoutes extends RouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const ROLE_WILDCARD = 'admin_auth_role';

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
            $this->name('roles.')->prefix('roles')->group(function () {
                $this->get('/', [RolesController::class, 'index'])
                     ->name('index'); // admin::auth.roles.index

                $this->mapDataTablesRoutes();

                $this->get('metrics', [RolesController::class, 'metrics'])
                     ->name('metrics'); // admin::auth.roles.metrics

                $this->get('create', [RolesController::class, 'create'])
                     ->name('create'); // admin::auth.roles.create

                $this->post('store', [RolesController::class, 'store'])
                     ->name('store'); // admin::auth.roles.store

                $this->prefix('{'.self::ROLE_WILDCARD.'}')->group(function () {
                    $this->get('/', [RolesController::class, 'show'])
                         ->name('show'); // admin::auth.roles.show

                    $this->get('edit', [RolesController::class, 'edit'])
                         ->name('edit'); // admin::auth.roles.edit

                    $this->put('update', [RolesController::class, 'update'])
                         ->name('update'); // admin::auth.roles.update

                    $this->put('activate', [RolesController::class, 'activate'])
                         ->middleware(['ajax'])
                         ->name('activate'); // admin::auth.roles.activate

                    $this->delete('delete', [RolesController::class, 'delete'])
                         ->middleware(['ajax'])
                         ->name('delete'); // admin::auth.roles.delete
                });
            });
        });
    }

    /**
     * Map datatables routes.
     *
     * @return void
     */
    protected function mapDataTablesRoutes(): void
    {
        $this->dataTableGroup(function () {
            $this->get('/', [RolesDataTablesController::class, 'index'])
                 ->name('index'); // admin::auth.roles.datatables.index
        });
    }

    /**
     * Register the route bindings.
     *
     * @return void
     */
    public function bindings(): void
    {
        $this->bind(self::ROLE_WILDCARD, function ($uuid) {
            return Auth::makeModel('role')
                ->newQuery()
                ->where('uuid', '=', $uuid)
                ->firstOrFail();
        });
    }
}
