<?php namespace Arcanesoft\Auth\Providers;

use Arcanesoft\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

/**
 * Class     AuthServiceProvider
 *
 * @package  Arcanesoft\Auth\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AuthServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::after(function ($user, $ability) {
            /** @var  \App\Models\User  $user */
            return $user->isSuperAdmin()
                || $user->isAdmin()
                || $user->may($ability);
        });

        $this->registerDefinitions(
            array_keys(config()->get('arcanesoft.auth.policies', []))
        );
    }
}
