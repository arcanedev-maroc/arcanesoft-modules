<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Controllers\Datatables;

use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Auth\Http\Transformers\RoleTransformer;
use Arcanesoft\Foundation\Auth\Repositories\RolesRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

/**
 * Class     RolesController
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Controllers\Datatables
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
        $query = $rolesRepo
            ->with(['users'])
            ->filterByAuthenticatedUser(Auth::admin());

        return $dataTables->eloquent($query)
            ->setTransformer(new RoleTransformer)
            ->make(true);
    }
}
