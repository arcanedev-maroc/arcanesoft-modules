<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Controllers\Auth;

use App\Http\Controllers\Auth\Concerns\RedirectsToHomePage;
use Arcanesoft\Foundation\Auth\Repositories\AdministratorsRepository;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Auth\{PasswordBroker, StatefulGuard};
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Password};
use Illuminate\Support\Str;
use Arcanesoft\Foundation\Auth\Auth as ArcanesoftAuth;

/**
 * Class     ResetPasswordController
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Controllers\Auth
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ResetPasswordController extends Controller
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use ResetsPasswords,
        RedirectsToHomePage;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Auth\Repositories\AdministratorsRepository */
    protected $repo;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * ResetPasswordController constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Repositories\AdministratorsRepository  $repo
     */
    public function __construct(AdministratorsRepository $repo)
    {
        $this->repo = $repo;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null               $token
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('foundation::auth.passwords.reset')->with([
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator  $administrator
     * @param  string                                            $password
     */
    protected function resetPassword($administrator, $password): void
    {
        $administrator->setRememberToken(Str::random(60));

        $this->repo->updatePassword($administrator, $password);

        event(new PasswordReset($administrator));

        $this->guard()->login($administrator);
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    protected function broker(): PasswordBroker
    {
        return Password::broker('administrators');
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard(): StatefulGuard
    {
        return Auth::guard(ArcanesoftAuth::GUARD_WEB_ADMINISTRATOR);
    }
}
