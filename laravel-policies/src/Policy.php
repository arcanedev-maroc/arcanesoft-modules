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
     * Get the ability's key.
     *
     * @param  string  $key
     *
     * @return string
     */
    public static function ability(string $key): string
    {
        return static::prefixedKey($key);
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
        return Ability::make(
            static::prefixedKey($key),
            static::prepareMethod($method ?: $key)
        );
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

    /**
     * Prepare the method name.
     *
     * @param  string  $method
     *
     * @return string|null
     */
    protected static function prepareMethod(string $method): ?string
    {
        // Dedicated Class
        if (class_exists($method))
            return $method;

        // Dedicated Method
        $method = Str::camel($method);

        if (method_exists(static::class, $method))
            return static::class.'@'.$method;

        return null;
    }
}
