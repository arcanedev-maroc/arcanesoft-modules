<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Controllers\Auth;

use App\Http\Controllers\Auth\Concerns\RedirectsToHomePage;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class     LoginController
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Controllers\Auth
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LoginController extends Controller
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use AuthenticatesUsers,
        RedirectsToHomePage;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('foundation::auth.login');
    }

    /**
     * Where to redirect users after verification.
     *
     * @return string
     */
    public function redirectTo(): string
    {
        return route('admin::index');
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    protected function loggedOut(Request $request)
    {
        return response()->json([
            'redirect' => route('public::index'),
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('administrator');
    }
}
