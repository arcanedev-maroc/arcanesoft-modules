<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Middleware;

use Arcanesoft\Foundation\Auth\Contracts\CanBeActivated;
use Closure;

/**
 * Class     EnsureIsActive
 *
 * @package  Arcanesoft\Foundation\Core\Http\Middleware
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class EnsureIsActive
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $next
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();

        if ( ! $this->isActivated($user))
            abort(403);

        return $next($request);
    }

    /**
     * Check if the given user has an `active` account.
     *
     * @param  mixed  $user
     *
     * @return bool
     */
    private function isActivated($user): bool
    {
        if ( ! $user instanceof CanBeActivated)
            return false;

        return $user->isActive();
    }
}
