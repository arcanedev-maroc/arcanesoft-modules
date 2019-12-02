<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Controllers\Datatables;

use Arcanesoft\Foundation\Auth\Http\Transformers\UserTransformer;
use Arcanesoft\Foundation\Auth\Repositories\UsersRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

/**
 * Class     UsersController
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Controllers\Datatables
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UsersController
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index(DataTables $dataTables, UsersRepository $usersRepo, bool $trash = false)
    {
        $query = $usersRepo->onlyTrashed($trash);

        return $dataTables->eloquent($query)
            ->setTransformer(new UserTransformer)
            ->make(true);
    }

    public function trash(DataTables $dataTables, UsersRepository $usersRepo)
    {
        return $this->index($dataTables, $usersRepo, true);
    }
}
