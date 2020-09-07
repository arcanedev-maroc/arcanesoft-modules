<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Concerns;

use Illuminate\Contracts\Auth\Factory as AuthContract;
use Illuminate\Contracts\Auth\StatefulGuard;

/**
 * Trait     HasAuth
 *
 * @package  Arcanesoft\Foundation\Fortify\Concerns
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait HasGuard
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the auth factory instance.
     *
     * @return \Illuminate\Auth\SessionGuard|mixed
     */
    protected function auth(): StatefulGuard
    {
        return app(AuthContract::class)->guard($this->guard());
    }

    /**
     * Get the guard name.
     *
     * @return string
     */
    abstract protected function guard(): string;
}
