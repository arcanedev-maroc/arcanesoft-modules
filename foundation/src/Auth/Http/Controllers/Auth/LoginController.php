<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Controllers\Auth;

use Arcanesoft\Foundation\Auth\Actions\Authentication\Login\{
    AttemptToAuthenticate, EnsureLoginIsNotThrottled, PrepareAuthenticatedSession, RedirectIfTwoFactorWasEnabled
};
use Arcanesoft\Foundation\Auth\Concerns\Authentication\UseAdministratorGuard;
use Arcanesoft\Foundation\Auth\Http\Requests\Authentication\LoginRequest;
use Arcanesoft\Foundation\Fortify\Http\Controllers\LoginController as Controller;
use Illuminate\Http\Request;

/**
 * Class     LoginController
 *
 * @package  App\Http\Controllers\Auth
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LoginController extends Controller
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use UseAdministratorGuard;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Show the login view.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        return view('foundation::auth.login');
    }

    /**
     * Attempt to authenticate a new session.
     *
     * @param  \Arcanesoft\Foundation\Auth\Http\Requests\Authentication\LoginRequest  $request
     *
     * @return mixed
     */
    public function store(LoginRequest $request)
    {
        return $this->login($request, [
            EnsureLoginIsNotThrottled::class,
            RedirectIfTwoFactorWasEnabled::class,
            AttemptToAuthenticate::class,
            PrepareAuthenticatedSession::class,
        ]);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->logout($request);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the redirect url after user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return string
     */
    protected function redirectUrlAfterLogin(Request $request): string
    {
        return route('admin::index');
    }

    /**
     * Get the redirect url after user was logout.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return string
     */
    protected function redirectUrlAfterLogout(Request $request): string
    {
        return route('public::index');
    }
}
