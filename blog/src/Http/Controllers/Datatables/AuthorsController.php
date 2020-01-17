<?php

declare(strict_types=1);

namespace Arcanesoft\Blog\Http\Controllers\Datatables;

use Arcanesoft\Blog\Http\Transformers\AuthorTransformer;
use Arcanesoft\Blog\Repositories\AuthorsRepository;
use Yajra\DataTables\DataTables;

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

    public function index(DataTables $dataTables, AuthorsRepository $authorsRepo)
    {
        $query = $authorsRepo->query()
            ->with(['creator'])
            ->withCount(['posts']);

        return $dataTables
            ->eloquent($query)
            ->setTransformer(new AuthorTransformer)
            ->make(true);
    }
}
