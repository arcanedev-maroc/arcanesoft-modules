<?php

namespace Arcanedev\LaravelPolicies\Contracts;

use Illuminate\Support\Collection;

/**
 * Class     Policy
 *
 * @package  Arcanedev\LaravelPolicies\Contracts
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @method  \Arcanedev\LaravelPolicies\Ability[]|iterable  abilities()
 */
interface Policy
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the FQN class.
     *
     * @return string
     */
    public static function class(): string;

    /**
     * Get all the abilities as collection.
     *
     * @return \Illuminate\Support\Collection
     */
    public function abilitiesAsCollection(): Collection;
}
