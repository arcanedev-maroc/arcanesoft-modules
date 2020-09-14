<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Concerns\Authentication;

use Arcanesoft\Foundation\Auth\Auth;

/**
 * Trait     UseAdministratorGuard
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait UseAdministratorGuard
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the guard name.
     *
     * @return string
     */
    protected function getGuardName(): string
    {
        return Auth::GUARD_WEB_ADMINISTRATOR;
    }
}
