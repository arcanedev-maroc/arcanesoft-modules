<?php

use Arcanesoft\Foundation\Events;
use Arcanesoft\Foundation\Listeners;

return [

    Events\UI\SidebarToggled::class => [
        Listeners\UI\PersistToggledSidebar::class,
    ],

    Events\UI\SkinModeToggled::class => [
        Listeners\UI\PersistToggledSkinMode::class,
    ],

];
