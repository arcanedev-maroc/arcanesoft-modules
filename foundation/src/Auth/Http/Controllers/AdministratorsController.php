<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Controllers;

use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Auth\Http\Requests\Admins\{CreateAdministratorRequest, UpdateAdministratorRequest};
use Arcanesoft\Foundation\Auth\Models\Admin;
use Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy;
use Arcanesoft\Foundation\Auth\Repositories\{AdministratorsRepository, RolesRepository};
use Arcanesoft\Foundation\Support\Traits\HasNotifications;

/**
 * Class     AdministratorsController
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Controllers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AdministratorsController extends Controller
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
     * List all the administrators.
     *
     * @param  bool  $trash
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index($trash = false)
    {
        $this->authorize(AdministratorsPolicy::ability('index'));

        $this->selectMetrics('arcanesoft.foundation.metrics.selected.auth-admins');

        return $this->view('authorization.admins.index', compact('trash'));
    }

    /**
     * List all the deleted administrators.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function trash()
    {
        return $this->index(true);
    }

    /**
     * Create a new administrator.
     *
     * @param  \Arcanesoft\Foundation\Auth\Repositories\RolesRepository  $rolesRepo
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(RolesRepository $rolesRepo)
    {
        $this->authorize(AdministratorsPolicy::ability('create'));

        $roles = $rolesRepo->getFilteredByAuthenticatedUser(Auth::admin());

        $this->addBreadcrumb(__('New Administrator'));

        return $this->view('authorization.admins.create', compact('roles'));
    }

    /**
     * Persist the new administrator.
     *
     * @param  \Arcanesoft\Foundation\Auth\Http\Requests\Admins\CreateAdministratorRequest  $request
     * @param  \Arcanesoft\Foundation\Auth\Repositories\AdministratorsRepository            $adminsRepo
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateAdministratorRequest $request, AdministratorsRepository $adminsRepo)
    {
        $this->authorize(AdministratorsPolicy::ability('create'));

        $data  = $request->getValidatedData();
        $admin = $adminsRepo->createOneWithRoles($data, $data['roles'] ?: []);

        $this->notifySuccess(
            __('Administrator Created'), __('A new administrator has been successfully created!')
        );

        return redirect()->route('admin::auth.administrators.show', [$admin]);
    }

    /**
     * Show the administrator's details.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin  $admin
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Admin $admin)
    {
        $this->authorize(AdministratorsPolicy::ability('show'), [$admin]);

        $this->addBreadcrumbRoute(__("Administrator's details"), 'admin::auth.administrators.show', [$admin]);

        return $this->view('authorization.admins.show', compact('admin'));
    }

    /**
     * Edit the administrator.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin                  $admin
     * @param  \Arcanesoft\Foundation\Auth\Repositories\RolesRepository  $rolesRepo
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Admin $admin, RolesRepository $rolesRepo)
    {
        $this->authorize(AdministratorsPolicy::ability('update'), [$admin]);

        $roles = $rolesRepo->getFilteredByAuthenticatedUser(Auth::admin());

        $this->addBreadcrumbRoute(__('Edit Administrator'), 'admin::auth.administrators.edit', [$admin]);

        return $this->view('authorization.admins.edit', compact('admin', 'roles'));
    }

    /**
     * Update the administrator.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin                                     $admin
     * @param  \Arcanesoft\Foundation\Auth\Http\Requests\Admins\UpdateAdministratorRequest  $request
     * @param  \Arcanesoft\Foundation\Auth\Repositories\AdministratorsRepository            $adminsRepo
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Admin $admin, UpdateAdministratorRequest $request, AdministratorsRepository $adminsRepo)
    {
        $this->authorize(AdministratorsPolicy::ability('update'), [$admin]);

        $data = $request->getValidatedData();

        $adminsRepo->updateOneWithRoles($admin, $data, $data['roles'] ?: []);

        $this->notifySuccess(
            __('Administrator Updated'), __('The administrator has been successfully updated!')
        );

        return redirect()->route('admin::auth.administrators.show', [$admin]);
    }

    /**
     * Activate/Deactivate an administrator.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin                           $user
     * @param  \Arcanesoft\Foundation\Auth\Repositories\AdministratorsRepository  $adminsRepo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function activate(Admin $user, AdministratorsRepository $adminsRepo)
    {
        $this->authorize(AdministratorsPolicy::ability('activate'), [$user]);

        $adminsRepo->toggleActive($user);

        $user->isActive()
            ? $this->notifySuccess(
                __('Administrator Activated'), __('The administrator has been successfully activated!')
            )
            : $this->notifySuccess(
                __('Administrator Deactivated'), __('The administrator has been successfully deactivated!')
            );

        return static::jsonResponseSuccess();
    }

    /**
     * Delete an administrator.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin                           $admin
     * @param  \Arcanesoft\Foundation\Auth\Repositories\AdministratorsRepository  $adminsRepo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Admin $admin, AdministratorsRepository $adminsRepo)
    {
        $this->authorize(AdministratorsPolicy::ability($admin->trashed() ? 'force-delete' : 'delete'), [$admin]);

        $adminsRepo->deleteOne($admin);

        $this->notifySuccess(
            __('Administrator Deleted'), __('The administrator has been successfully deleted!')
        );

        return static::jsonResponseSuccess();
    }

    /**
     * Restore a deleted administrator.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin                           $admin
     * @param  \Arcanesoft\Foundation\Auth\Repositories\AdministratorsRepository  $adminsRepo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(Admin $admin, AdministratorsRepository $adminsRepo)
    {
        $this->authorize(AdministratorsPolicy::ability('restore'), [$admin]);

        $adminsRepo->restoreOne($admin);

        $this->notifySuccess(
            __('Administrator Restored'), __('The administrator has been successfully restored!')
        );

        return static::jsonResponseSuccess();
    }
}
