<?php

namespace Arcanesoft\Auth\Http\Controllers;

use Arcanesoft\Auth\Models\Permission;
use Arcanesoft\Auth\Policies\PermissionsPolicy;

/**
 * Class     PermissionsController
 *
 * @package  Arcanesoft\Auth\Http\Controllers
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
        $this->addBreadcrumbRoute(__('Permissions'), 'admin::auth.permissions.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index()
    {
        $this->authorize(PermissionsPolicy::ability('index'));

        return $this->view('permissions.index');
    }

    public function show(Permission $permission)
    {
        $this->authorize(PermissionsPolicy::ability('show'));

        $permission->load(['roles.users']);

        $this->addBreadcrumbRoute(__("Permission's details"), 'admin::auth.permissions.show', [$permission]);

        return $this->view('permissions.show', compact('permission'));
    }
}
