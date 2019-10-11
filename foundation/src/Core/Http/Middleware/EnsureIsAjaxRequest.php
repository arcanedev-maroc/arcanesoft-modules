<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Middleware;

use Closure;

/**
 * Class     EnsureIsAjaxRequest
 *
 * @package  Arcanesoft\Foundation\Core\Http\Middleware
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class EnsureIsAjaxRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( ! $this->isAjaxRequest($request))
            abort(400, 'Bad Request');

        return $next($request);
    }

    /**
     * Ensure it's an ajax request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return mixed
     */
    protected function isAjaxRequest($request)
    {
        return $request->ajax();
    }
}
