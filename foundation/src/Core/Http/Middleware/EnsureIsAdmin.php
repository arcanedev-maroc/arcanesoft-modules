<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Middleware;

use Closure;

/**
 * Class     EnsureIsAdmin
 *
 * @package  Arcanesoft\Foundation\Core\Http\Middleware
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
        //

        return $next($request);
    }
}
