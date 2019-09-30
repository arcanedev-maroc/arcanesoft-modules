<?php namespace Arcanesoft\Blog\Http\Routes;

use Arcanesoft\Blog\Base\RouteRegistrar;
use Arcanesoft\Blog\Blog;
use Arcanesoft\Blog\Http\Controllers\AuthorsController;
use Arcanesoft\Blog\Http\Controllers\Datatables\AuthorsController as AuthorsDataTablesController;

/**
 * Class     AuthorsRoutes
 *
 * @package  Arcanesoft\Blog\Http\Routes
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AuthorsRoutes extends RouteRegistrar
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const AUTHOR_WILDCARD = 'admin_blog_author';

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
            $this->prefix('authors')->name('authors.')->group(function () {
                $this->get('/', [AuthorsController::class, 'index'])
                     ->name('index'); // admin::blog.authors.index

                $this->mapDataTablesRoutes();

                $this->get('metrics', [AuthorsController::class, 'metrics'])
                     ->name('metrics'); // admin::blog.authors.metrics

                $this->get('create', [AuthorsController::class, 'create'])
                     ->name('create'); // admin::blog.authors.create

                $this->post('store', [AuthorsController::class, 'store'])
                     ->name('store'); // admin::blog.authors.store

                $this->prefix('{'.static::AUTHOR_WILDCARD.'}')->group(function () {
                    $this->get('/', [AuthorsController::class, 'show'])
                         ->name('show'); // admin::blog.authors.show

                    $this->get('edit', [AuthorsController::class, 'edit'])
                         ->name('edit'); // admin::blog.authors.edit

                    $this->put('update', [AuthorsController::class, 'update'])
                         ->name('update'); // admin::blog.authors.update

                    $this->delete('delete', [AuthorsController::class, 'delete'])
                         ->middleware(['ajax'])
                         ->name('delete'); // admin::blog.authors.delete
                });
            });
        });
    }

    /**
     * Map the datatables routes.
     */
    private function mapDataTablesRoutes(): void
    {
        $this->dataTableGroup(function () {
            $this->get('/', [AuthorsDataTablesController::class, 'index'])
                 ->name('index'); // admin::auth.users.datatables.index
        });
    }

    /**
     * Register the bindings.
     *
     * @return void
     */
    public function bindings(): void
    {
        $this->bind(static::AUTHOR_WILDCARD, function ($uuid) {
            return Blog::makeModel('author')
                ->where('uuid', $uuid)
                ->firstOrFail();
        });
    }
}
