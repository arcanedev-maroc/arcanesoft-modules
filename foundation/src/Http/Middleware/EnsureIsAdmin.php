<?php namespace Arcanesoft\Foundation\Http\Middleware;

use Closure;

/**
 * Class     EnsureIsAdmin
 *
 * @package  Arcanesoft\Foundation\Http\Middleware
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class EnsureIsAdmin
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
        $this->ensureUserCanAccessAdminPanel($request->user());

        return $next($request);
    }

    /**
     * Check if the given user is an administrator.
     *
     * @param  \App\Models\User|mixed  $user
     */
    protected function ensureUserCanAccessAdminPanel($user)
    {
        if (is_null($user))
            abort(404, 'Page not found');

        if ( ! $user->isAdmin() && ! $user->isModerator())
            abort(404, 'Page not found');
    }
}
