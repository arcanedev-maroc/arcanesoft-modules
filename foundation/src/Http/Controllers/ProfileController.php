<?php namespace Arcanesoft\Foundation\Http\Controllers;

use Arcanesoft\Auth\Repositories\UsersRepository;
use Arcanesoft\Foundation\Concerns\HasNotifications;
use Arcanesoft\Foundation\Http\Requests\Profile\UpdateUserAccountRequest;
use Arcanesoft\Foundation\Http\Requests\Profile\UpdateUserPasswordRequest;
use Illuminate\Http\Request;

/**
 * Class     ProfileController
 *
 * @package  Arcanesoft\Foundation\Http\Controllers
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

        $this->addBreadcrumbRoute(__('Profile'), 'admin::foundation.profile.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index(Request $request)
    {
        return $this->view('profile.index', [
            'user' => $request->user(),
        ]);
    }

    public function updateAccount(UpdateUserAccountRequest $request, UsersRepository $repo)
    {
        $repo->update(
            $request->user(),
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
        $repo->update(
            $request->user(),
            $request->getValidatedData()
        );

        $this->notifySuccess(
            __('Password Updated'),
            __('Your password has been successfully updated !')
        );

        return redirect()->back();
    }
}
