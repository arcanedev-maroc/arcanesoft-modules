<?php

namespace Arcanedev\LaravelPolicies;

use Arcanedev\LaravelPolicies\Contracts\Policy as PolicyContract;
use Illuminate\Support\{Collection, Str};

/**
 * Class     Policy
 *
 * @package  Arcanedev\LaravelPolicies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class Policy implements PolicyContract
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Use current class to define ability's method.
     *
     * @var bool
     */
    protected $useCurrentClass = true;

    /* -----------------------------------------------------------------
     |  Getters
     | -----------------------------------------------------------------
     */

    /**
     * Get the ability's prefix.
     *
     * @return string
     */
    protected static function prefix(): string
    {
        return static::$prefix;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the FQN class.
     *
     * @return string
     */
    public static function class(): string
    {
        return static::class;
    }

    /**
     * Get the ability key.
     *
     * @param  string  $key
     *
     * @return string
     */
    public static function ability(string $key)
    {
        return static::prefixedKey($key);
    }

    /**
     * Get all the abilities as collection.
     *
     * @return \Illuminate\Support\Collection
     */
    public function abilitiesAsCollection(): Collection
    {
        return new Collection(
            app()->call([$this, 'abilities'])
        );
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

        if (is_string($method) && $this->useCurrentClass)
            $method = static::class().'@'.$method;

        return Ability::make(static::prefixedKey($key), $method);
    }

    /**
     * Get a prefixed key.
     *
     * @param  string  $key
     *
     * @return string
     */
    protected static function prefixedKey(string $key): string
    {
        return empty($prefix = static::prefix())
            ? $key
            : trim($prefix.$key);
    }
}
