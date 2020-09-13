<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Controllers\Auth;

use App\Http\Requests\Authentication\ResetPasswordRequest;
use Arcanesoft\Foundation\Auth\Http\Routes\Auth\LoginRoutes;
use Arcanesoft\Foundation\Fortify\Http\Controllers\ResetPasswordController as Controller;
use Illuminate\Http\Request;

/**
 * Class     ResetPasswordController
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Controllers\Auth
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ResetPasswordController extends Controller
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Show the new password view.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
        return view('foundation::auth.passwords.reset', [
            'token' => $request->route('token'),
            'email' => $request->input('email'),
        ]);
    }

    /**
     * Reset the user's password.
     *
     * @param  \App\Http\Requests\Authentication\ResetPasswordRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(ResetPasswordRequest $request)
    {
        return $this->resetPassword($request, $request->validated());
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the password broker's driver.
     *
     * @return string|null
     */
    protected function getBrokerDriver(): string
    {
        return 'administrators';
    }

    /**
     * Get the redirect URL.
     *
     * @return string
     */
    protected function getRedirectUrl(): string
    {
        return route(LoginRoutes::LOGIN_CREATE);
    }
}
