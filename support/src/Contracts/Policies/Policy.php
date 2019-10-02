<?php

namespace Arcanesoft\Support\Contracts\Policies;

use Illuminate\Support\Collection;

/**
 * Interface     Policy
 *
 * @package  Arcanesoft\Support\Contracts\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface Policy
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the policy's abilities.
     *
     * @return \Arcanesoft\Support\Policies\Ability[]|array
     */
    public function abilities(): array;
}
