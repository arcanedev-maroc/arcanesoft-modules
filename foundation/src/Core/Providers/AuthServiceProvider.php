<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Providers;

use Arcanesoft\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

/**
 * Class     AuthServiceProvider
 *
 * @package  Arcanesoft\Foundation\Core\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AuthServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Getters
     | -----------------------------------------------------------------
     */

    /**
     * Get policy's classes.
     *
     * @return array
     */
    public function policyClasses(): array
    {
        return $this->app['config']->get('arcanesoft.foundation.policies', []);
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Boot the service provider.
     */
    public function boot(): void
    {
        Gate::after(function ($user, string $ability) {
            /** @var  \App\Models\User  $user */
            return $user->isAdmin()
                || $user->may($ability);
        });

        parent::boot();
    }
}
