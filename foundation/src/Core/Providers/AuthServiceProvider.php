<?php

namespace Arcanesoft\Foundation\Core\Providers;

use Arcanedev\LaravelPolicies\Contracts\PolicyManager;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

/**
 * Class     AuthServiceProvider
 *
 * @package  Arcanesoft\Foundation\Core\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class AuthServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Policy's classes.
     *
     * @var array
     */
    protected $policyClasses = [];

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Boot the service provider.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        $this->registerPolicyClasses();
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the policy's classes.
     */
    protected function registerPolicyClasses(): void
    {
        $manager = $this->app->make(PolicyManager::class);

        foreach ($this->policyClasses() as $class) {
            $manager->registerClass($class);
        }
    }

    /**
     * Get policy's classes.
     *
     * @return iterable
     */
    public function policyClasses(): iterable
    {
        return $this->policyClasses;
    }
}