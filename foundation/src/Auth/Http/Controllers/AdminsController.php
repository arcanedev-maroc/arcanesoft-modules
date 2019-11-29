<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Controllers;

use Arcanesoft\Foundation\Auth\Http\Requests\Admins\{CreateAdminRequest, UpdateAdminRequest};
use Arcanesoft\Foundation\Auth\Models\Admin;
use Arcanesoft\Foundation\Auth\Policies\AdminsPolicy;
use Arcanesoft\Foundation\Auth\Repositories\{AdminsRepository, RolesRepository};
use Arcanesoft\Foundation\Support\Traits\HasNotifications;
use Illuminate\Http\Request;

/**
 * Class     AdminsController
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Controllers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AdminsController extends Controller
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasNotifications;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct()
    {
        parent::__construct();

        $this->setCurrentSidebarItem('auth::authorization.administrators');

        $this->addBreadcrumbParent();
        $this->addBreadcrumbRoute(__('Administrators'), 'admin::auth.administrators.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * List all the admins.
     *
     * @param  bool  $trash
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index($trash = false)
    {
        $this->authorize(AdminsPolicy::ability('index'));

        return $this->view('authorization.admins.index', compact('trash'));
    }

    /**
     * List all the deleted admins.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function trash()
    {
        $this->authorize(AdminsPolicy::ability('index'));

        return $this->index(true);
    }

    /**
     * Show the metrics.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function metrics()
    {
        $this->authorize(AdminsPolicy::ability('metrics'));

        $this->addBreadcrumbRoute(__('Metrics'), 'admin::auth.administrators.metrics');

        $this->selectMetrics('arcanesoft.foundation.metrics.selected.auth-admins');

        return $this->view('authorization.admins.metrics');
    }

    /**
     * Create a new user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Repositories\RolesRepository  $rolesRepo
     * @param  \Illuminate\Http\Request                                  $request
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(RolesRepository $rolesRepo, Request $request)
    {
        $this->authorize(AdminsPolicy::ability('create'));

        $roles = $rolesRepo->getFilteredByAuthenticatedUser($request->user());

        $this->addBreadcrumb(__('New Administrator'));

        return $this->view('authorization.admins.create', compact('roles'));
    }

    /**
     * Persist the new user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Http\Requests\Admins\CreateAdminRequest  $request
     * @param  \Arcanesoft\Foundation\Auth\Repositories\AdminsRepository            $adminsRepo
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateAdminRequest $request, AdminsRepository $adminsRepo)
    {
        $this->authorize(AdminsPolicy::ability('create'));

        $data = $request->getValidatedData();

        $adminsRepo->syncRolesByUuids(
            $admin = $adminsRepo->createAdmin($data),
            $data['roles'] ?: []
        );

        $this->notifySuccess(
            __('Administrator Created'),
            __('A new administrator has been successfully created!')
        );

        return redirect()->route('admin::auth.administrators.show', [$admin]);
    }

    /**
     * Show the user's details.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin  $admin
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Admin $admin)
    {
        $this->authorize(AdminsPolicy::ability('show'), [$admin]);

        $this->addBreadcrumbRoute(__("Administrator's details"), 'admin::auth.administrators.show', [$admin]);

        return $this->view('authorization.admins.show', compact('admin'));
    }

    /**
     * Edit the user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin                  $admin
     * @param  \Arcanesoft\Foundation\Auth\Repositories\RolesRepository  $rolesRepo
     * @param  \Illuminate\Http\Request                                  $request
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Admin $admin, RolesRepository $rolesRepo, Request $request)
    {
        $this->authorize(AdminsPolicy::ability('update'), [$admin]);

        $roles = $rolesRepo->getFilteredByAuthenticatedUser($request->user());

        $this->addBreadcrumbRoute(__('Edit Administrator'), 'admin::auth.administrators.edit', [$admin]);

        return $this->view('authorization.admins.edit', compact('admin', 'roles'));
    }

    /**
     * Update the user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin                             $admin
     * @param  \Arcanesoft\Foundation\Auth\Http\Requests\Admins\UpdateAdminRequest  $request
     * @param  \Arcanesoft\Foundation\Auth\Repositories\AdminsRepository            $adminsRepo
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Admin $admin, UpdateAdminRequest $request, AdminsRepository $adminsRepo)
    {
        $this->authorize(AdminsPolicy::ability('update'), [$admin]);

        $adminsRepo->updateAdmin($admin, $request->getValidatedData());

        $this->notifySuccess(
            __('Administrator Updated'),
            __('The administrator has been successfully updated!')
        );

        return redirect()->route('admin::auth.administrators.show', [$admin]);
    }

    /**
     * Activate/Deactivate the user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin                   $user
     * @param  \Arcanesoft\Foundation\Auth\Repositories\AdminsRepository  $adminsRepo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function activate(Admin $user, AdminsRepository $adminsRepo)
    {
        $this->authorize(AdminsPolicy::ability('activate'), [$user]);

        $adminsRepo->toggleActive($user);

        $this->notifySuccess(
            __($user->isActive() ? 'Administrator Activated' : 'Administrator Deactivated'),
            __($user->isActive() ? 'The administrator has been successfully activated!' : 'The administrator has been successfully deactivated!')
        );

        return static::jsonResponseSuccess();
    }

    /**
     * Delete a user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin                   $admin
     * @param  \Arcanesoft\Foundation\Auth\Repositories\AdminsRepository  $adminsRepo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Admin $admin, AdminsRepository $adminsRepo)
    {
        $this->authorize(AdminsPolicy::ability($admin->trashed() ? 'force-delete' : 'delete'), [$admin]);

        $adminsRepo->deleteAdmin($admin);

        $this->notifySuccess(
            __('Administrator Deleted'),
            __('The administrator has been successfully deleted!')
        );

        return static::jsonResponseSuccess();
    }

    /**
     * Restore a deleted user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin                   $admin
     * @param  \Arcanesoft\Foundation\Auth\Repositories\AdminsRepository  $adminsRepo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(Admin $admin, AdminsRepository $adminsRepo)
    {
        $this->authorize(AdminsPolicy::ability('restore'), [$admin]);

        $adminsRepo->restoreAdmin($admin);

        $this->notifySuccess(
            __('Administrator Restored'),
            __('The administrator has been successfully restored!')
        );

        return static::jsonResponseSuccess();
    }
}