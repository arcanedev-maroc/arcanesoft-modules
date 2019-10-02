<?php

namespace Arcanesoft\Support\Policies;

use Arcanesoft\Support\Contracts\Policies\Policy as PolicyContract;
use Illuminate\Support\{Collection, Str};

/**
 * Class     Policy
 *
 * @package  Arcanesoft\Support\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class Policy implements PolicyContract
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Ability's prefix.
     *
     * @var string|null
     */
    protected $prefix;

    /**
     * Use current class to define ability's method.
     *
     * @var bool
     */
    protected $useCurrentClass = true;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get all the abilities as collection.
     *
     * @return \Illuminate\Support\Collection
     */
    public function abilitiesAsCollection(): Collection
    {
        return new Collection($this->abilities());
    }

    /**
     * Get the ability key from the policy.
     *
     * @param  string  $id
     *
     * @return string
     */
    public static function ability(string $key): ?string
    {
        // TODO: Find another workaround for this
        /** @var  \Illuminate\Support\Collection  $abilities */
        $abilities = app()->call(static::class.'@abilitiesAsCollection');

        /** @var  \Arcanesoft\Support\Policies\Ability|null  $ability */
        $ability = $abilities->first(function (Ability $ability) use ($key) {
            return Str::endsWith($ability->key(), $key);
        });

        return is_null($ability) ? '' : $ability->key();
    }

    /**
     * Make a new ability.
     *
     * @param  string       $key
     * @param  string|null  $method
     *
     * @return \Arcanedev\LaravelPolicies\Ability
     */
    protected function makeAbility(string $key, $method = null): Ability
    {
        if (is_null($method))
            $method = Str::camel($key);

        if ( ! is_null($this->prefix))
            $key = trim($this->prefix.$key);

        if (is_string($method) && $this->useCurrentClass)
            $method = static::class.'@'.$method;

        return Ability::make($key, $method);
    }
}
