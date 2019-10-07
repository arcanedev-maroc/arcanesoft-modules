<?php 

namespace Arcanesoft\Auth\Http\Controllers;

use Arcanedev\LaravelImpersonator\Contracts\Impersonator;
use Arcanesoft\Auth\Http\Requests\Users\{CreateUserRequest, UpdateUserRequest};
use Arcanesoft\Auth\Models\User;
use Arcanesoft\Auth\Policies\UsersPolicy;
use Arcanesoft\Auth\Repositories\{RolesRepository, UsersRepository};
use Arcanesoft\Foundation\Concerns\HasNotifications;

/**
 * Class     UsersController
 *
 * @package  Arcanesoft\Auth\Http\Controllers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UsersController extends Controller
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

        $this->setCurrentSidebarItem('auth::authorization.users');
        $this->addBreadcrumbRoute(__('Users'), 'admin::auth.users.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index($trash = false)
    {
        $this->authorize(UsersPolicy::ability('index'));

        return $this->view('users.index', compact('trash'));
    }

    public function trash()
    {
        $this->authorize(UsersPolicy::ability('index'));

        return $this->index(true);
    }

    public function metrics()
    {
        $this->authorize(UsersPolicy::ability('metrics'));

        $this->addBreadcrumbRoute(__('Metrics'), 'admin::auth.users.metrics');

        $this->selectMetrics('arcanesoft.auth.metrics.users');

        return $this->view('users.metrics');
    }

    public function create(RolesRepository $rolesRepo)
    {
        $this->authorize(UsersPolicy::ability('create'));

        $roles = $rolesRepo->all();

        $this->addBreadcrumb(__('New User'));

        return $this->view('users.create', compact('roles'));
    }

    public function store(CreateUserRequest $request, UsersRepository $usersRepo)
    {
        $this->authorize(UsersPolicy::ability('create'));

        $user = $usersRepo->create($request->getValidatedData());

        $this->notifySuccess(
            __('User Created'),
            __('A new user has been successfully created!')
        );

        return redirect()->route('admin::auth.users.show', [$user]);
    }

    public function show(User $user)
    {
        $this->authorize(UsersPolicy::ability('show'));

        $this->addBreadcrumbRoute(__("User's details"), 'admin::auth.users.show', [$user]);

        return $this->view('users.show', compact('user'));
    }

    public function edit(User $user, RolesRepository $rolesRepo)
    {
        $this->authorize(UsersPolicy::ability('update'), [$user]);

        $roles = $rolesRepo->all();

        $this->addBreadcrumbRoute(__('Edit User'), 'admin::auth.users.edit', [$user]);

        return $this->view('users.edit', compact('user', 'roles'));
    }

    public function update(User $user, UpdateUserRequest $request, UsersRepository $usersRepo)
    {
        $this->authorize(UsersPolicy::ability('update'), [$user]);

        $usersRepo->update($user, $request->getValidatedData());

        $this->notifySuccess(
            __('User Updated'),
            __('The user has been successfully updated!')
        );

        return redirect()->route('admin::auth.users.show', [$user]);
    }

    public function activate(User $user, UsersRepository $usersRepo)
    {
        $this->authorize(UsersPolicy::ability('activate'), [$user]);

        $usersRepo->toggleActive($user);

        $this->notifySuccess(
            __($user->isActive() ? 'User Activated' : 'User Deactivated'),
            __($user->isActive() ? 'The user has been successfully activated!' : 'The user has been successfully deactivated!')
        );

        return static::jsonResponseSuccess();
    }

    public function delete(User $user, UsersRepository $usersRepo)
    {
        $this->authorize(UsersPolicy::ability($user->trashed() ? 'force-delete' : 'delete'), [$user]);

        $usersRepo->delete($user);

        $this->notifySuccess(
            __('User Deleted'),
            __('The user has been successfully deleted!')
        );

        return static::jsonResponseSuccess();
    }

    public function restore(User $user, UsersRepository $usersRepo)
    {
        $this->authorize(UsersPolicy::ability('restore'), [$user]);

        $usersRepo->restore($user);

        $this->notifySuccess(
            __('User Restored'),
            __('The user has been successfully restored!')
        );

        return static::jsonResponseSuccess();
    }

    public function impersonate(User $user, Impersonator $impersonator)
    {
        $this->authorize(UsersPolicy::ability('impersonate'), [$user]);

        /**
         * @var  \Arcanedev\LaravelImpersonator\Contracts\Impersonatable  $authUser
         * @var  \Arcanedev\LaravelImpersonator\Contracts\Impersonatable  $user
         */
        $authUser = auth()->user();

        if ($impersonator->start($authUser, $user))
            return redirect()->route('public::index');

        $this->notifyError(
            __('Impersonation Not Allowed'),
            __("You're not allowed to impersonate this user")
        );

        return redirect()->back();
    }
}
