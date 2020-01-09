<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth;

use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Contracts\Provider;
use Laravel\Socialite\Facades\Socialite as LaravelSocialite;

/**
 * Class     Socialite
 *
 * @package  Arcanesoft\Foundation\Auth
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Socialite
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the accepted socialite providers.
     *
     * @return array
     */
    public static function getAcceptedProviders(): array
    {
        return Auth::config('authentication.socialite.drivers', []);
    }

    /**
     * Get the provider's authorization.
     *
     * @param  string  $provider
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function getProviderAuthorization(string $provider): RedirectResponse
    {
        $options = config("services.{$provider}", []);

        return tap(static::driver($provider), function (Provider $socialite) use ($provider, $options) {
            $scopes = $options['scopes'] ?? [];
            $with   = $options['with'] ?? [];
            $fields = $options['fields'] ?? [];

            if ( ! empty($scopes))
                $socialite->scopes($scopes);

            if ( ! empty($with))
                $socialite->with($with);

            if ( ! empty($fields))
                $socialite->fields($fields);
        })->redirect();
    }

    /**
     * Get the socialite's user.
     *
     * @param  string  $provider
     *
     * @return \Laravel\Socialite\Contracts\User|\Laravel\Socialite\One\User|\Laravel\Socialite\Two\User
     */
    public static function user(string $provider)
    {
        return static::driver($provider)->user();
    }

    /**
     * Get the socialite's driver.
     *
     * @param  string  $provider
     *
     * @return \Laravel\Socialite\Contracts\Provider
     */
    public static function driver(string $provider)
    {
        return LaravelSocialite::driver($provider);
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if socialite is enabled.
     *
     * @return bool
     */
    public static function isEnabled(): bool
    {
        return (bool) Auth::config('authentication.socialite.enabled', false);
    }

    /**
     * Check if the given provider is supported.
     *
     * @param  string  $provider
     *
     * @return bool
     */
    public static function isAcceptedProvider(string $provider): bool
    {
        return in_array($provider, static::getAcceptedProviders(), true);
    }
}