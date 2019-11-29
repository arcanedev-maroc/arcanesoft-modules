<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Middleware;

use Arcanesoft\Foundation\Auth\Models\Admin;
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
        $admin = $request->user('admin');

        $this->ensureIsAdminAccount($admin);
        $this->ensureAccountIsActivated($admin);

        return $next($request);
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check the authenticated user is an admin.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin|mixed  $admin
     */
    protected function ensureIsAdminAccount($admin)
    {
        abort_unless($admin instanceof Admin, 403, 'Forbidden');
    }

    /**
     * Check the authenticated admin has an active account.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin|mixed  $admin
     */
    protected function ensureAccountIsActivated($admin)
    {
        abort_unless($admin->isActive(), 403, 'Account not activated');
    }
}
