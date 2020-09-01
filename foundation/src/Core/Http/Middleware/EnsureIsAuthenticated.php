<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Middleware\AuthenticatesRequests;
use Illuminate\Contracts\Auth\Factory as Auth;


/**
 * Class     EnsureIsAuthenticated
 *
 * @package  Arcanesoft\Foundation\Core\Http\Middleware
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class EnsureIsAuthenticated implements AuthenticatesRequests
{
    /**
     * The authentication factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

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
        $this->isAuthenticated();

        return $next($request);
    }

    /**
     * Determine if the user is logged in.
     */
    protected function isAuthenticated()
    {
        $guard = \Arcanesoft\Foundation\Auth\Auth::GUARD_WEB_ADMINISTRATOR;

        abort_unless($this->auth->guard($guard)->check(), 404);

        $this->auth->shouldUse($guard);
    }
}
