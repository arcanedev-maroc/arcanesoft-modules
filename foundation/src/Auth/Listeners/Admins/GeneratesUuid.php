<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Listeners\Admins;

use Arcanesoft\Foundation\Auth\Events\Admins\CreatingAdmin;
use Illuminate\Support\Str;

/**
 * Class     GeneratesUuid
 *
 * @package  Arcanesoft\Foundation\Auth\Listeners\Admins
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
     * @param  \Arcanesoft\Foundation\Auth\Events\Admins\CreatingAdmin  $event
     */
    public function handle(CreatingAdmin $event)
    {
        $event->admin->forceFill(['uuid' => Str::uuid()]);
    }
}