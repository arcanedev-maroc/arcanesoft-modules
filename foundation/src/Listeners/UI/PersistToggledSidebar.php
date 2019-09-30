<?php namespace Arcanesoft\Foundation\Listeners\UI;

use Arcanesoft\Foundation\Events\UI\SidebarToggled;

/**
 * Class     PersistSidebarStatus
 *
 * @package  Arcanesoft\Foundation\Listeners\UI
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PersistToggledSidebar
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the event.
     *
     * @param  \Arcanesoft\Foundation\Events\UI\SidebarToggled  $event
     *
     * @return void
     */
    public function handle(SidebarToggled $event)
    {
        session([
            'foundation.sidebar.visible' => $event->options['visible'] ?? 'true',
        ]);
    }
}
