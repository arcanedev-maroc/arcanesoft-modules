<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Controllers\Datatables;

use Arcanesoft\Foundation\Auth\Http\Transformers\PermissionTransformer;
use Arcanesoft\Foundation\Auth\Repositories\PermissionsRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

/**
 * Class     PermissionsController
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Controllers\Datatables
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PermissionsController
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index(DataTables $dataTables, PermissionsRepository $permissionsRepo, Request $request)
    {
        $query = $permissionsRepo->with(['group', 'roles' => function ($query) use ($request) {
            return $query->filterByAuthenticatedUser($request->user());
        }]);

        return $dataTables->eloquent($query)
            ->setTransformer(new PermissionTransformer)
            ->make(true);
    }
}
