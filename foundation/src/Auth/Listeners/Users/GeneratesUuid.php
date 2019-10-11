<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Listeners\Users;

use Arcanesoft\Foundation\Auth\Events\Users\CreatingUser;
use Illuminate\Support\Str;

/**
 * Class     GeneratesUuid
 *
 * @package  Arcanesoft\Foundation\Auth\Listeners\Users
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class GeneratesUuid
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the event.
     *
     * @param  \Arcanesoft\Foundation\Auth\Events\Users\CreatingUser  $event
     */
    public function handle(CreatingUser $event)
    {
        $event->user->forceFill(['uuid' => Str::uuid()]);
    }
}
