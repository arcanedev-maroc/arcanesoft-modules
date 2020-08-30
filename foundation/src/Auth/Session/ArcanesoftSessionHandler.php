<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Session;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Session\DatabaseSessionHandler;

/**
 * Class     ArcanesoftSessionHandler
 *
 * @package  Arcanesoft\Foundation\Auth\Session
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ArcanesoftSessionHandler extends DatabaseSessionHandler
{
    /**
     * Add the user information to the session payload.
     *
     * @param  array  $payload
     *
     * @return $this
     */
    protected function addUserInformation(&$payload)
    {
        if ($this->container->bound(Guard::class)) {
            /** @var  \Arcanesoft\Foundation\Auth\Models\User|\Arcanesoft\Foundation\Auth\Models\Administrator  $user */
            $guard = $this->container->make(Guard::class);

            $payload['user_id'] = $guard->id();
            $payload['guard']   = explode('_', $guard->getName())[1] ?? null;
        }

        return $this;
    }
}
