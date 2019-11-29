<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Routes;

use Arcanesoft\Foundation\Auth\Http\Controllers\Datatables\AdminsController as AdminsDatatablesController;
use Arcanesoft\Foundation\Auth\Http\Controllers\AdminsController;
use Arcanesoft\Foundation\Auth\Repositories\AdminsRepository;

/**
 * Class     AdminsRoutes
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AdminsRoutes extends AbstractRouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const USER_WILDCARD = 'admin_auth_admin';

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
            $this->name('administrators.')->prefix('administrators')->group(function () {
                // admin::auth.administrators.index
                $this->get('/', [AdminsController::class, 'index'])
                     ->name('index');

                // admin::auth.administrators.trash
                $this->get('trash', [AdminsController::class, 'trash'])
                     ->name('trash');

                $this->mapDataTablesRoutes();

                // admin::auth.administrators.metrics
                $this->get('metrics', [AdminsController::class, 'metrics'])
                     ->name('metrics');

                // admin::auth.administrators.create
                $this->get('create', [AdminsController::class, 'create'])
                     ->name('create');

                // admin::auth.administrators.post
                $this->post('store', [AdminsController::class, 'store'])
                     ->name('store');

                $this->prefix('{'.static::USER_WILDCARD.'}')->group(function () {
                    // admin::auth.administrators.show
                    $this->get('/', [AdminsController::class, 'show'])
                         ->name('show');

                    // admin::auth.administrators.edit
                    $this->get('edit', [AdminsController::class, 'edit'])
                         ->name('edit');

                    // admin::auth.administrators.update
                    $this->put('update', [AdminsController::class, 'update'])
                         ->name('update');

                    // admin::auth.administrators.activate
                    $this->put('activate', [AdminsController::class, 'activate'])
                         ->middleware(['ajax'])
                         ->name('activate');

                    // admin::auth.administrators.delete
                    $this->delete('delete', [AdminsController::class, 'delete'])
                         ->middleware(['ajax'])
                         ->name('delete');

                    // admin::auth.administrators.restore
                    $this->put('restore', [AdminsController::class, 'restore'])
                         ->middleware(['ajax'])
                         ->name('restore');
                });
            });
        });
    }

    /**
     * Map the datatables routes.
     */
    protected function mapDataTablesRoutes(): void
    {
        $this->dataTableGroup(function () {
            // admin::auth.administrators.datatables.index
            $this->get('/', [AdminsDataTablesController::class, 'index'])
                 ->name('index');

            // admin::auth.administrators.datatables.trash
            $this->get('trash', [AdminsDataTablesController::class, 'trash'])
                 ->name('trash');
        });
    }

    /**
     * Register the route bindings.
     *
     * @param  \Arcanesoft\Foundation\Auth\Repositories\AdminsRepository  $repo
     */
    public function bindings(AdminsRepository $repo): void
    {
        $this->bind(static::USER_WILDCARD, function (string $uuid) use ($repo) {
            return $repo->firstWhereUuidOrFail($uuid);
        });
    }
}
