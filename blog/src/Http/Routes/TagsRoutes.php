<?php

namespace Arcanesoft\Blog\Http\Routes;

use Arcanesoft\Blog\Blog;
use Arcanesoft\Blog\Http\Controllers\Datatables\TagsController as TagsDatatablesController;
use Arcanesoft\Blog\Http\Controllers\TagsController;

/**
 * Class     TagsRoutes
 *
 * @package  Arcanesoft\Blog\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TagsRoutes extends RouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const TAG_WILDCARD = 'admin_blog_tag';

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
            $this->prefix('tags')->name('tags.')->group(function () {
                $this->get('/', [TagsController::class, 'index'])
                     ->name('index'); // admin::blog.tags.index

                $this->mapDataTablesRoutes();

                $this->get('metrics', [TagsController::class, 'metrics'])
                     ->name('metrics'); // admin::blog.tags.metrics

                $this->get('create', [TagsController::class, 'create'])
                     ->name('create'); // admin::blog.tags.create

                $this->post('store', [TagsController::class, 'store'])
                     ->name('store'); // admin::blog.tags.store

                $this->prefix('{'.static::TAG_WILDCARD.'}')->group(function () {
                    $this->get('/', [TagsController::class, 'show'])
                         ->name('show'); // admin::blog.tags.show

                    $this->get('edit', [TagsController::class, 'edit'])
                         ->name('edit'); // admin::blog.tags.edit

                    $this->put('update', [TagsController::class, 'update'])
                         ->name('update'); // admin::blog.tags.update

                    $this->delete('delete', [TagsController::class, 'delete'])
                         ->name('delete'); // admin::blog.tags.delete
                });
            });
        });
    }

    /**
     * Map datatables routes.
     */
    private function mapDataTablesRoutes(): void
    {
        $this->dataTableGroup(function () {
            $this->get('/', [TagsDataTablesController::class, 'index'])
                 ->name('index'); // admin::blog.tags.datatables.index
        });
    }

    /**
     * Register the route bindings.
     */
    public function bindings(): void
    {
        $this->bind(static::TAG_WILDCARD, function ($uuid) {
            return Blog::makeModel('tag')
                ->newQuery()
                ->where('uuid', '=', $uuid)
                ->firstOrFail();
        });
    }
}
