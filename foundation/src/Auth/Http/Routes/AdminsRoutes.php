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
            $this->name('admins.')->prefix('admins')->group(function () {
                // admin::auth.admins.index
                $this->get('/', [AdminsController::class, 'index'])
                     ->name('index');

                // admin::auth.admins.trash
                $this->get('trash', [AdminsController::class, 'trash'])
                     ->name('trash');

                $this->mapDataTablesRoutes();

                // admin::auth.admins.metrics
                $this->get('metrics', [AdminsController::class, 'metrics'])
                     ->name('metrics');

                // admin::auth.admins.create
                $this->get('create', [AdminsController::class, 'create'])
                     ->name('create');

                // admin::auth.admins.post
                $this->post('store', [AdminsController::class, 'store'])
                     ->name('store');

                $this->prefix('{'.static::USER_WILDCARD.'}')->group(function () {
                    // admin::auth.admins.show
                    $this->get('/', [AdminsController::class, 'show'])
                         ->name('show');

                    // admin::auth.admins.edit
                    $this->get('edit', [AdminsController::class, 'edit'])
                         ->name('edit');

                    // admin::auth.admins.update
                    $this->put('update', [AdminsController::class, 'update'])
                         ->name('update');

                    // admin::auth.admins.activate
                    $this->put('activate', [AdminsController::class, 'activate'])
                         ->middleware(['ajax'])
                         ->name('activate');

                    // admin::auth.admins.delete
                    $this->delete('delete', [AdminsController::class, 'delete'])
                         ->middleware(['ajax'])
                         ->name('delete');

                    // admin::auth.admins.restore
                    $this->put('restore', [AdminsController::class, 'restore'])
                         ->middleware(['ajax'])
                         ->name('restore');

                    if (impersonator()->isEnabled()) {
                        // admin::auth.admins.impersonate
                        $this->get('impersonate', [AdminsController::class, 'impersonate'])
                             ->name('impersonate');
                    }
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
            // admin::auth.admins.datatables.index
            $this->get('/', [AdminsDataTablesController::class, 'index'])
                 ->name('index');

            // admin::auth.admins.datatables.trash
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
