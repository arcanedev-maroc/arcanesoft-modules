<?php namespace Arcanesoft\Auth\Listeners\Roles;

use Arcanesoft\Auth\Events\Roles\DeletingRole;

/**
 * Class     DetachingPermissions
 *
 * @package  Arcanesoft\Auth\Listeners\Roles
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachPermissions
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
        $event->role->permissions()->detach();
    }
}
