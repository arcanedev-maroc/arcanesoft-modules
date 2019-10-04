<?php

namespace Arcanedev\LaravelPolicies;

use Arcanedev\LaravelPolicies\Contracts\PolicyManager as PolicyManagerContract;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Auth\Access\Gate;

/**
 * Class     PolicyManager
 *
 * @package  Arcanedev\LaravelPolicies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PolicyManager implements PolicyManagerContract
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Illuminate\Contracts\Foundation\Application */
    protected $app;

    /** @var  \Illuminate\Support\Collection */
    protected $policies;

    /** @var  \Illuminate\Support\Collection */
    protected $abilities;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * PolicyManager constructor.
     */
    public function __construct(Application $app)
    {
        $this->app       = $app;
        $this->policies  = new Collection;
        $this->abilities = new Collection;
    }

    /* -----------------------------------------------------------------
     |  Getters
     | -----------------------------------------------------------------
     */

    /**
     * Get the registered policies.
     *
     * @return \Illuminate\Support\Collection
     */
    public function policies(): Collection
    {
        return $this->policies;
    }

    /**
     * Get the registered abilities.
     *
     * @return \Illuminate\Support\Collection
     */
    public function abilities(): Collection
    {
        return $this->abilities;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register a policy class.
     *
     * @param  string  $class
     *
     * @return $this
     */
    public function registerClass(string $class): PolicyManagerContract
    {
        return $this->register(
            $this->app->make($class)
        );
    }

    /**
     * Register a policy instance.
     *
     * @param  \Arcanedev\LaravelPolicies\Contracts\Policy  $policy
     *
     * @return $this
     */
    public function register(Contracts\Policy $policy): PolicyManagerContract
    {
        $this->policies->put(get_class($policy), $policy);

        return $this->registerAbilities(
            $this->app->call([$policy, 'abilities'])
        );
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the abilities into the gate access.
     *
     * @param  \Arcanedev\LaravelPolicies\Ability[]|array  $abilities
     *
     * @return $this
     */
    protected function registerAbilities(iterable $abilities)
    {
        foreach ($abilities as $ability) {
            $this->registerAbility($ability);
        }

        return $this;
    }

    /**
     * Register the ability object.
     *
     * @param  \Arcanedev\LaravelPolicies\Ability  $ability
     *
     * @return $this
     */
    protected function registerAbility(Ability $ability)
    {
        $this->abilities->put($ability->key(), $ability);
        $this->gate()->define($ability->key(), $ability->method());

        return $this;
    }

    /**
     * Get the gate access instance.
     *
     * @return \Illuminate\Contracts\Auth\Access\Gate|mixed
     */
    protected function gate(): Gate
    {
        return $this->app->make(Gate::class);
    }
}