<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Middleware;

use Arcanesoft\Foundation\Auth\Models\Admin;
use Closure;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Contracts\Auth\Guard;

/**
 * Class     EnsureIsAdmin
 *
 * @package  Arcanesoft\Foundation\Core\Http\Middleware
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class EnsureIsAdmin
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The authentication factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * @var string
     */
    protected $guard = 'admin';

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

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
        $user = $this->guard()->user();

        $this->check($user);

        return $next($request);
    }

    /**
     * Get the auth guard.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    protected function guard(): Guard
    {
        return $this->auth->guard($this->guard);
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check the user.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable|mixed|null  $user
     */
    protected function check(?Authenticatable $user)
    {
        $this->ensureIsAuthenticated($user);
        $this->ensureIsAdministrator($user);
        $this->ensureAccountIsActivated($user);
    }

    /**
     * Check if authenticated.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin|mixed  $user
     */
    protected function ensureIsAuthenticated($user)
    {
        abort_if(is_null($user), 404);

        if ($this->guard()->check()) {
            $this->auth->shouldUse($this->guard);
        }
    }

    /**
     * Check the authenticated user is an administrator.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin|mixed  $user
     */
    protected function ensureIsAdministrator($user)
    {
        abort_unless($user instanceof Admin, 403, 'Forbidden');
    }

    /**
     * Check the authenticated admin has an active account.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin|mixed  $user
     */
    protected function ensureAccountIsActivated($user)
    {
        abort_unless($user->isActive(), 403, 'Account not activated');
    }
}
