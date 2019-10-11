<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Controllers\Datatables;

use Arcanesoft\Foundation\Auth\Http\Transformers\PasswordResetTransformer;
use Arcanesoft\Foundation\Auth\Repositories\PasswordResetsRepository;
use Yajra\DataTables\DataTables;

/**
 * Class     PasswordResetsController
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Controllers\Datatables
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PasswordResetsController
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index(DataTables $dataTables, PasswordResetsRepository $repo)
    {
        $query = $repo->query();

        return $dataTables->eloquent($query)
            ->setTransformer(new PasswordResetTransformer)
            ->make(true);
    }
}
