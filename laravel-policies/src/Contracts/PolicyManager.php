<?php

namespace Arcanedev\LaravelPolicies\Contracts;

use Illuminate\Support\Collection;

/**
 * Interface     PolicyManager
 *
 * @package  Arcanedev\LaravelPolicies\Contracts
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface PolicyManager
{
    /* -----------------------------------------------------------------
     |  Getters
     | -----------------------------------------------------------------
     */

    /**
     * Get the registered policies.
     *
     * @return \Illuminate\Support\Collection
     */
    public function policies(): Collection;

    /**
     * Get the registered abilities.
     *
     * @return \Illuminate\Support\Collection
     */
    public function abilities(): Collection;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register a policy class.
     *
     * @param  string  $class
     *
     * @return \Arcanedev\LaravelPolicies\PolicyManager
     */
    public function registerClass(string $class): self;

    /**
     * Register a policy instance.
     *
     * @param  \Arcanedev\LaravelPolicies\Contracts\Policy  $policy
     *
     * @return $this
     */
    public function register(Policy $policy): self;
}
