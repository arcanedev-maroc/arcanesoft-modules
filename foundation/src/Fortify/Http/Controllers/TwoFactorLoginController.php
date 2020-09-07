<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Http\Controllers;

use Arcanesoft\Foundation\Fortify\Concerns\HasGuard;
use Arcanesoft\Foundation\Fortify\Http\Requests\TwoFactorLoginRequest;
use Illuminate\Http\{Request, Response};
use Illuminate\Validation\ValidationException;

/**
 * Class     TwoFactorLoginController
 *
 * @package  Arcanesoft\Foundation\Fortify\Http\Controllers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class TwoFactorLoginController
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasGuard;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /*
     * Attempt to authenticate a new session using the two factor authentication code.
     *
     * @param  \Arcanesoft\Foundation\Fortify\Http\Requests\TwoFactorLoginRequest|mixed  $request
     *
     * @return mixed
     */
    protected function login(TwoFactorLoginRequest $request)
    {
        $user = $request->challengedUser();

        if (is_null($user)) {
            return $this->getFailedTwoFactorLoginResponse($request);
        }

        if ($code = $request->validRecoveryCode()) {
            $user->replaceRecoveryCode($code);
        }
        elseif ( ! $request->hasValidCode()) {
            return $this->getFailedTwoFactorLoginResponse($request);
        }

        $this->auth()->login($user, $request->remember());

        return $this->getTwoFactorLoginResponse($request, $user);
    }

    /**
     * Get the two factor success response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed                     $user
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function getTwoFactorLoginResponse(Request $request, $user)
    {
        if ($request->wantsJson())
            return new Response('', Response::HTTP_NO_CONTENT);

        return redirect()->to($this->getRedirectUrlAfterLogin($request, $user));
    }

    /**
     * Get the failed two factor response.
     *
     * @param  \Illuminate\Http\Request|mixed  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function getFailedTwoFactorLoginResponse(Request $request)
    {
        $message = __('The provided two factor authentication code was invalid.');

        if ($request->wantsJson()) {
            throw ValidationException::withMessages([
                'code' => [$message],
            ]);
        }

        return redirect()
            ->to($this->getFailedTwoFactorRedirectUrl($request))
            ->withErrors(['email' => $message]);
    }

    /**
     * Get the two factor's redirect url after login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed                     $user
     *
     * @return string
     */
    abstract protected function getRedirectUrlAfterLogin(Request $request, $user): string;

    /**
     * Get the failed two factor's redirect url.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return string
     */
    abstract protected function getFailedTwoFactorRedirectUrl(Request $request): string;
}
