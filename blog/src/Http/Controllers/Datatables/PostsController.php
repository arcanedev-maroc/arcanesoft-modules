<?php namespace Arcanesoft\Blog\Http\Controllers\Datatables;

use Arcanesoft\Blog\Http\Transformers\PostTransformer;
use Arcanesoft\Blog\Repositories\PostsRepository;

/**
 * Class     PostsDataTablesController
 *
 * @package  Arcanesoft\Blog\Http\Controllers\Datatables
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PostsController
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index(PostsRepository $postsRepo)
    {
        return datatables()->eloquent($postsRepo->query())
            ->setTransformer(new PostTransformer)
            ->make(true);
    }
}
