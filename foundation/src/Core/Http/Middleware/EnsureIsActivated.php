<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Middleware;

use Closure;

/**
 * Class     EnsureIsActivated
 *
 * @package  Arcanesoft\Foundation\Core\Http\Middleware
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class EnsureIsActivated
{
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
        $this->ensureUserIsActivated($request->user());

        return $next($request);
    }

    /**
     * Check if the user account is activated.
     *
     * @param  \App\Models\User|mixed  $user
     */
    protected function ensureUserIsActivated($user)
    {
        if (is_null($user) || ! $user->isActive())
            abort(403, 'Forbidden');
    }
}
