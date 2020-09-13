<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Controllers\Auth;

use Arcanesoft\Foundation\Auth\Http\Requests\Authentication\SendPasswordResetLinkRequest;
use Arcanesoft\Foundation\Fortify\Http\Controllers\PasswordResetLinkController as Controller;
use Illuminate\Http\Request;

/**
 * Class     PasswordResetLinkController
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PasswordResetLinkController extends Controller
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Show the reset password link request view.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('foundation::auth.passwords.forgot');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param \Arcanesoft\Foundation\Auth\Http\Requests\Authentication\SendPasswordResetLinkRequest $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(SendPasswordResetLinkRequest $request)
    {
        return $this->sendResetLink($request, $request->validated());
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
    protected function getBrokerDriver(): ?string
    {
        return 'administrators';
    }
}
