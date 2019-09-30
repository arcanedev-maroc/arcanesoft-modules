<?php namespace Arcanesoft\Auth\Http\Controllers\Datatables;

use Arcanesoft\Auth\Http\Transformers\RoleTransformer;
use Arcanesoft\Auth\Repositories\RolesRepository;
use Yajra\DataTables\DataTables;

/**
 * Class     RolesController
 *
 * @package  Arcanesoft\Auth\Http\Controllers\Datatables
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RolesController
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index(DataTables $dataTables, RolesRepository $rolesRepo)
    {
        $query = $rolesRepo->query()->with(['users']);

        return $dataTables->eloquent($query)
            ->setTransformer(new RoleTransformer)
            ->make(true);
    }
}
