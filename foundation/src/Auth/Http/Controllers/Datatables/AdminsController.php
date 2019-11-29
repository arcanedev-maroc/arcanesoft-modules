<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Controllers\Datatables;

use Arcanesoft\Foundation\Auth\Http\Transformers\AdminTransformer;
use Arcanesoft\Foundation\Auth\Repositories\AdminsRepository;
use Yajra\DataTables\DataTables;

/**
 * Class     AdminsController
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Controllers\Datatables
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AdminsController
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index(DataTables $dataTables, AdminsRepository $usersRepo, bool $trash = false)
    {
        $query = $usersRepo->onlyTrashed($trash);

        return $dataTables->eloquent($query)
            ->setTransformer(new AdminTransformer)
            ->make(true);
    }

    public function trash(DataTables $dataTables, AdminsRepository $usersRepo)
    {
        return $this->index($dataTables, $usersRepo, true);
    }
}