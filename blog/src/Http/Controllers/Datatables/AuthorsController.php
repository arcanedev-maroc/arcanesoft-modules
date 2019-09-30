<?php namespace Arcanesoft\Blog\Http\Controllers\Datatables;

use Arcanesoft\Blog\Http\Transformers\AuthorTransformer;
use Arcanesoft\Blog\Repositories\AuthorsRepository;

/**
 * Class     AuthorsController
 *
 * @package  Arcanesoft\Blog\Http\Controllers\Datatables
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AuthorsController
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index(AuthorsRepository $authorsRepo)
    {
        $query = $authorsRepo->query()
            ->with(['user'])
            ->withCount(['posts']);

        return datatables()->eloquent($query)
            ->setTransformer(new AuthorTransformer)
            ->make(true);
    }
}
