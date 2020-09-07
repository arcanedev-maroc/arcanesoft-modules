<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Actions\Authentication\Login;

use Arcanesoft\Foundation\Auth\Concerns\Authentication\UseAdministratorGuard;
use Arcanesoft\Foundation\Fortify\Actions\Authentication\Login\AttemptToAuthenticate as Action;

/**
 * Class     EnsureLoginIsNotThrottled
 *
 * @package  App\Actions\Auth\Login
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class EnsureLoginIsNotThrottled extends Action
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use UseAdministratorGuard;
}
