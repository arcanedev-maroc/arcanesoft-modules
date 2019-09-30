<?php namespace Arcanesoft\Auth\Listeners\Roles;

use Arcanesoft\Auth\Events\Roles\DeletingRole;

/**
 * Class     DetachUsers
 *
 * @package  Arcanesoft\Auth\Listeners\Roles
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachUsers
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the event.
     *
     * @param  \Arcanesoft\Auth\Events\Roles\DeletingRole  $event
     */
    public function handle(DeletingRole $event)
    {
        $event->role->users()->detach();
    }
}
