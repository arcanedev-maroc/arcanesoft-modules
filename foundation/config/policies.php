<?php

use Arcanesoft\Foundation\Policies;

return [

    /* -----------------------------------------------------------------
     |  Policies
     | -----------------------------------------------------------------
     */

    Policies\DashboardPolicy::class => [
        'category' => 'Dashboard',
    ],

    Policies\System\InformationPolicy::class => [
        'category' => 'Information',
    ],

    Policies\System\MaintenancePolicy::class => [
        'category' => 'Maintenance',
    ],

    Policies\System\LogViewerPolicy::class => [
        'category' => 'LogViewer',
    ],

    Policies\System\RouteViewerPolicy::class => [
        'category' => 'RouteViewer',
    ],

];
