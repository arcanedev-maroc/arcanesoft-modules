<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Actions\Authentication\Login;

use Arcanesoft\Foundation\Auth\Concerns\Authentication\UseAdministratorGuard;
use Arcanesoft\Foundation\Fortify\Actions\Authentication\Login\RedirectIfTwoFactorWasEnabled as Action;
use Illuminate\Http\Request;

/**
 * Class     RedirectIfTwoFactorWasEnabled
 *
 * @package  App\Actions\Auth\Login
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RedirectIfTwoFactorWasEnabled extends Action
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use UseAdministratorGuard;

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the two factor redirect url.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return string
     */
    protected function getTwoFactorUrl(Request $request)
    {
        return route('auth::admin.login.two-factor.create');
    }
}
