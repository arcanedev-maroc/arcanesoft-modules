<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\RequirePassword as Middleware;
use Illuminate\Http\Request;

/**
 * Class     RequirePassword
 *
 * @package  Arcanesoft\Foundation\Core\Http\Middleware
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RequirePassword extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $next
     * @param  string|null               $redirectToRoute
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $redirectToRoute = null)
    {
        return parent::handle($request, $next, $redirectToRoute ?? 'auth::admin.password.confirm');
    }
}
