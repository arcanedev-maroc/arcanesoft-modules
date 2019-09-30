<?php namespace Arcanesoft\Foundation\Listeners\UI;

use Arcanesoft\Foundation\Events\UI\SkinModeToggled;

/**
 * Class     PersistToggledSkinMode
 *
 * @package  Arcanesoft\Foundation\Listeners\UI
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PersistToggledSkinMode
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the event.
     *
     * @param  \Arcanesoft\Foundation\Events\UI\SkinModeToggled  $event
     *
     * @return void
     */
    public function handle(SkinModeToggled $event)
    {
        session([
            'foundation.skin.mode' => $event->options['mode'] ?? 'light',
        ]);
    }
}
