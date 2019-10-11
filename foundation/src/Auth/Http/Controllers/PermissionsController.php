<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Controllers;

use Arcanesoft\Foundation\Auth\Models\Permission;
use Arcanesoft\Foundation\Auth\Policies\PermissionsPolicy;
use Illuminate\Http\Request;

/**
 * Class     PermissionsController
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Controllers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PermissionsController extends Controller
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct()
    {
        parent::__construct();

        $this->setCurrentSidebarItem('auth::authorization.permissions');

        $this->addBreadcrumbParent();
        $this->addBreadcrumbRoute(__('Permissions'), 'admin::auth.permissions.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index()
    {
        $this->authorize(PermissionsPolicy::ability('index'));

        return $this->view('auth.permissions.index');
    }

    public function show(Permission $permission, Request $request)
    {
        $this->authorize(PermissionsPolicy::ability('show'));

        // TODO: Use a repo instead
        $roles = $permission->roles()->filterByAuthenticatedUser($request->user())->get();

        $this->addBreadcrumbRoute(__("Permission's details"), 'admin::auth.permissions.show', [$permission]);

        return $this->view('auth.permissions.show', compact('permission', 'roles'));
    }
}
