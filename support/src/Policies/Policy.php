<?php

namespace Arcanesoft\Support\Policies;

use Arcanesoft\Support\Policies\Concerns\HasAbilities;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class     Policy
 *
 * @package  Arcanesoft\Support\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class Policy
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HandlesAuthorization,
        HasAbilities;
}

