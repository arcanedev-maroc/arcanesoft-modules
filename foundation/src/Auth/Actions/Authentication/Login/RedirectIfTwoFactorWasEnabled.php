<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Actions\Authentication\Login;

use Arcanesoft\Foundation\Auth\Concerns\Authentication\UseAdministratorGuard;
use Arcanesoft\Foundation\Fortify\Actions\Authentication\Login\RedirectIfTwoFactorWasEnabled as Action;

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
}
