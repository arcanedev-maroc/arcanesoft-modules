<?php

namespace Arcanesoft\Blog\Http\Routes;

use Arcanesoft\Blog\Http\Controllers\PostsController;
use Arcanesoft\Blog\Http\Controllers\Datatables\PostsController as PostsDataTablesController;

/**
 * Class     PostsRoutes
 *
 * @package  Arcanesoft\Blog\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PostsRoutes extends RouteRegistrar
{
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
            $this->prefix('posts')->name('posts.')->group(function () {
                $this->get('/', [PostsController::class, 'index'])
                     ->name('index'); // admin::blog.posts.index

                $this->mapDataTablesRoutes();

                $this->get('metrics', [PostsController::class, 'metrics'])
                     ->name('metrics'); // admin::blog.posts.metrics

                $this->get('create', [PostsController::class, 'create'])
                     ->name('create'); // admin::blog.posts.create

                $this->post('store', [PostsController::class, 'store'])
                     ->name('store'); // admin::blog.posts.store
            });
        });
    }

    /**
     * Map the datatable routes.
     */
    private function mapDataTablesRoutes(): void
    {
        $this->dataTableGroup(function () {
            $this->get('/', [PostsDataTablesController::class, 'index'])
                 ->name('index'); // admin::auth.users.datatables.index
        });
    }
}
