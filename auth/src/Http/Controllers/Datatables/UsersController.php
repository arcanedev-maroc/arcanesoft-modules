<?php namespace Arcanesoft\Auth\Http\Controllers\Datatables;

use Arcanesoft\Auth\Http\Transformers\UserTransformer;
use Arcanesoft\Auth\Models\User;
use Arcanesoft\Auth\Repositories\UsersRepository;
use Yajra\DataTables\DataTables;

/**
 * Class     UsersController
 *
 * @package  Arcanesoft\Auth\Http\Controllers\Datatables
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
