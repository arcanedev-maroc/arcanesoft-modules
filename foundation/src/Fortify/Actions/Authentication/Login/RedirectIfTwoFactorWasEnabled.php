<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Actions\Authentication\Login;

use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Auth\Models\Concerns\HasTwoFactorAuthentication;
use Arcanesoft\Foundation\Fortify\Concerns\HasGuard;
use Arcanesoft\Foundation\Fortify\LoginRateLimiter;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * Class     RedirectIfTwoFactorWasEnabled
 *
 * @package  Arcanesoft\Foundation\Fortify\Actions\Authentication\Login
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class RedirectIfTwoFactorWasEnabled
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasGuard;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The login rate limiter instance.
     *
     * @var \Arcanesoft\Foundation\Fortify\LoginRateLimiter
     */
    protected $limiter;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * RedirectIfTwoFactorWasEnabled constructor.
     *
     * @param  \Arcanesoft\Foundation\Fortify\LoginRateLimiter  $limiter
     */
    public function __construct(LoginRateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $this->validateCredentials(
            $request, $this->auth()->getProvider()->getModel()
        );

        if ($this->shouldUseTwoFactor($user)) {
            $request->session()->put([
                'login.id'       => $user->getKey(),
                'login.remember' => $request->filled('remember'),
            ]);

            return $this->twoFactorChallengeResponse($request);
        }

        return $next($request);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Determine if it should use the two factor feature.
     *
     * @param  \App\Models\User|mixed  $user
     *
     * @return bool
     */
    protected function shouldUseTwoFactor($user): bool
    {
        if ( ! Auth::isTwoFactorEnabled())
            return false;

        return optional($user)->two_factor_secret
            && in_array(HasTwoFactorAuthentication::class, class_uses_recursive($user));
    }

    /**
     * Attempt to validate the incoming credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string                    $model
     *
     * @return mixed
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateCredentials(Request $request, string $model)
    {
        $username = Auth::username();
        $user     = $model::where($username, $request->{$username})->first();

        if ( ! $user || ! Hash::check($request->input('password'), $user->password)) {
            $this->limiter->increment($request);

            throw ValidationException::withMessages([
                $username => [trans('auth.failed')],
            ]);
        }

        return $user;
    }

    /**
     * Get the two factor authentication enabled response.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function twoFactorChallengeResponse(Request $request)
    {
        return $request->wantsJson()
            ? response()->json(['two_factor' => true])
            : redirect()->route('two-factor.login');
    }
}
