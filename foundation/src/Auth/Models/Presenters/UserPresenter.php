<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Models\Presenters;

/**
 * Trait     UserPresenter
 *
 * @package  Arcanesoft\Foundation\Auth\Models\Presenters
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property-read  string  last_activity
 */
trait UserPresenter
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use AuthenticatablePresenter;
}
