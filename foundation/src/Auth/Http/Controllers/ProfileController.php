<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Controllers;

use Arcanesoft\Foundation\Auth\Http\Requests\Profile\{UpdateUserAccountRequest, UpdateUserPasswordRequest};
use Arcanesoft\Foundation\Auth\Repositories\UsersRepository;
use Arcanesoft\Foundation\Support\Traits\HasNotifications;
use Illuminate\Http\Request;

/**
 * Class     ProfileController
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Controllers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ProfileController extends Controller
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

        $this->addBreadcrumbRoute(__('Profile'), 'admin::auth.profile.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index(Request $request)
    {
        return $this->view('authorization.profile.index', [
            'user' => $request->user('admin'),
        ]);
    }

    public function updateAccount(UpdateUserAccountRequest $request, UsersRepository $repo)
    {
        $repo->updateUser(
            $request->user('admin'),
            $request->getValidatedData()
        );

        $this->notifySuccess(
            __('Account Updated'),
            __('Your account has been successfully updated !')
        );

        return redirect()->back();
    }

    public function updatePassword(UpdateUserPasswordRequest $request, UsersRepository $repo)
    {
        $repo->updateUser(
            $request->user('admin'),
            $request->getValidatedData()
        );

        $this->notifySuccess(
            __('Password Updated'),
            __('Your password has been successfully updated !')
        );

        return redirect()->back();
    }
}
