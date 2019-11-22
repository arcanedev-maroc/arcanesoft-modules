<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Controllers;

use Arcanedev\LaravelImpersonator\Contracts\Impersonator;
use Arcanesoft\Foundation\Auth\Http\Requests\Admins\{CreateAdminRequest, UpdateAdminRequest};
use Arcanesoft\Foundation\Auth\Models\Admin;
use Arcanesoft\Foundation\Auth\Policies\AdminsPolicy;
use Arcanesoft\Foundation\Auth\Repositories\{RolesRepository, AdminsRepository};
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

        $this->setCurrentSidebarItem('auth::authorization.admins');

        $this->addBreadcrumbParent();
        $this->addBreadcrumbRoute(__('Admins'), 'admin::auth.admins.index');
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

        $this->addBreadcrumbRoute(__('Metrics'), 'admin::auth.admins.metrics');

        $this->selectMetrics('arcanesoft.foundation.metrics.selected.auth-admins');

        return $this->view('authorization.admins.metrics');
    }

    /**
     * Create a new user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Repositories\RolesRepository  $rolesRepo
     * @param  \Illuminate\Http\Request                       $request
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(RolesRepository $rolesRepo, Request $request)
    {
        $this->authorize(AdminsPolicy::ability('create'));

        $roles = $rolesRepo->getFilteredByAuthenticatedUser($request->user());

        $this->addBreadcrumb(__('New Admin'));

        return $this->view('authorization.admins.create', compact('roles'));
    }

    /**
     * Persist the new user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Http\Requests\Admins\CreateAdminRequest  $request
     * @param  \Arcanesoft\Foundation\Auth\Repositories\AdminsRepository           $adminsRepo
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateAdminRequest $request, AdminsRepository $adminsRepo)
    {
        $this->authorize(AdminsPolicy::ability('create'));

        $data = $request->getValidatedData();

        $adminsRepo->syncRolesByUuids(
            $user = $adminsRepo->createAdmin($data),
            $data['roles'] ?: []
        );

        $this->notifySuccess(
            __('Admin Created'),
            __('A new user has been successfully created!')
        );

        return redirect()->route('admin::auth.admins.show', [$user]);
    }

    /**
     * Show the user's details.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin  $user
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Admin $user)
    {
        $this->authorize(AdminsPolicy::ability('show'), [$user]);

        $this->addBreadcrumbRoute(__("Admin's details"), 'admin::auth.admins.show', [$user]);

        return $this->view('authorization.admins.show', compact('user'));
    }

    /**
     * Edit the user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin                   $user
     * @param  \Arcanesoft\Foundation\Auth\Repositories\RolesRepository  $rolesRepo
     * @param  \Illuminate\Http\Request                       $request
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Admin $user, RolesRepository $rolesRepo, Request $request)
    {
        $this->authorize(AdminsPolicy::ability('update'), [$user]);

        $roles = $rolesRepo->getFilteredByAuthenticatedUser($request->user());

        $this->addBreadcrumbRoute(__('Edit Admin'), 'admin::auth.admins.edit', [$user]);

        return $this->view('authorization.admins.edit', compact('user', 'roles'));
    }

    /**
     * Update the user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin                            $user
     * @param  \Arcanesoft\Foundation\Auth\Http\Requests\Admins\UpdateAdminRequest  $request
     * @param  \Arcanesoft\Foundation\Auth\Repositories\AdminsRepository           $adminsRepo
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Admin $user, UpdateAdminRequest $request, AdminsRepository $adminsRepo)
    {
        $this->authorize(AdminsPolicy::ability('update'), [$user]);

        $adminsRepo->updateAdmin($user, $request->getValidatedData());

        $this->notifySuccess(
            __('Admin Updated'),
            __('The user has been successfully updated!')
        );

        return redirect()->route('admin::auth.admins.show', [$user]);
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
            __($user->isActive() ? 'Admin Activated' : 'Admin Deactivated'),
            __($user->isActive() ? 'The user has been successfully activated!' : 'The user has been successfully deactivated!')
        );

        return static::jsonResponseSuccess();
    }

    /**
     * Delete a user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin                   $user
     * @param  \Arcanesoft\Foundation\Auth\Repositories\AdminsRepository  $adminsRepo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Admin $user, AdminsRepository $adminsRepo)
    {
        $this->authorize(AdminsPolicy::ability($user->trashed() ? 'force-delete' : 'delete'), [$user]);

        $adminsRepo->deleteAdmin($user);

        $this->notifySuccess(
            __('Admin Deleted'),
            __('The user has been successfully deleted!')
        );

        return static::jsonResponseSuccess();
    }

    /**
     * Restore a deleted user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin                   $user
     * @param  \Arcanesoft\Foundation\Auth\Repositories\AdminsRepository  $adminsRepo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(Admin $user, AdminsRepository $adminsRepo)
    {
        $this->authorize(AdminsPolicy::ability('restore'), [$user]);

        $adminsRepo->restoreAdmin($user);

        $this->notifySuccess(
            __('Admin Restored'),
            __('The user has been successfully restored!')
        );

        return static::jsonResponseSuccess();
    }

    /**
     * Impersonate a user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin                           $user
     * @param  \Arcanedev\LaravelImpersonator\Contracts\Impersonator  $impersonator
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function impersonate(Admin $user, Impersonator $impersonator)
    {
        $this->authorize(AdminsPolicy::ability('impersonate'), [$user]);

        /**
         * @var  \Arcanedev\LaravelImpersonator\Contracts\Impersonatable  $authAdmin
         * @var  \Arcanedev\LaravelImpersonator\Contracts\Impersonatable  $user
         */
        $authAdmin = auth()->user();

        if ($impersonator->start($authAdmin, $user))
            return redirect()->route('public::index');

        $this->notifyError(
            __('Impersonation Not Allowed'),
            __('You\'re not allowed to impersonate this user')
        );

        return redirect()->back();
    }
}