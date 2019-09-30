<?php namespace Arcanesoft\Auth\Http\Controllers\Datatables;

use Arcanesoft\Auth\Http\Transformers\PermissionTransformer;
use Arcanesoft\Auth\Repositories\PermissionsRepository;
use Yajra\DataTables\DataTables;

/**
 * Class     PermissionsController
 *
 * @package  Arcanesoft\Auth\Http\Controllers\Datatables
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PermissionsController
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * @param  \Yajra\DataTables\DataTables                         $dataTables
     * @param  \Arcanesoft\Auth\Repositories\PermissionsRepository  $permissionsRepo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(DataTables $dataTables, PermissionsRepository $permissionsRepo)
    {
        $query = $permissionsRepo->query()->with(['group', 'roles']);

        return $dataTables->eloquent($query)
            ->setTransformer(new PermissionTransformer)
            ->make(true);
    }
}
