<?php

use Arcanesoft\Auth\Models\Role;

return [

    /* -----------------------------------------------------------------
     |  Items
     | -----------------------------------------------------------------
     */

    'items' => [
        // Dashboard
        [
            'name'        => 'foundation::dashboard',
            'title'       => 'Dashboard',
            'icon'        => 'fa fa-fw fa-tachometer-alt',
            'route'       => 'admin::index',
            'roles'       => [Role::ADMINISTRATOR, Role::MODERATOR],
            'permissions' => [],
        ],

        // Modules' sidebar items
        'arcanesoft.blog.sidebar.items',
        'arcanesoft.auth.sidebar.items',
        'arcanesoft.media.sidebar.items',

        // System
        [
            'name'        => 'foundation::system',
            'title'       => 'System',
            'icon'        => 'fas fa-fw fa-desktop',
            'route'       => 'admin::index',
            'roles'       => [Role::ADMINISTRATOR],
            'permissions' => [],
            'children'    => [
                [
                    'name'        => 'foundation::system.info',
                    'title'       => 'Information',
                    'icon'        => 'fas fa-fw fa-info-circle',
                    'route'       => 'admin::foundation.system.index',
                    'roles'       => [Role::ADMINISTRATOR],
                    'permissions' => [
                        'admin::foundation.system.index',
                    ],
                ],
                [
                    'name'        => 'foundation::system.maintenance',
                    'title'       => 'Maintenance',
                    'icon'        => 'far fa-fw fa-stop-circle',
                    'route'       => 'admin::foundation.system.maintenance.index',
                    'roles'       => [Role::ADMINISTRATOR],
                    'permissions' => [
                        'admin::foundation.system.maintenance.index',
                    ],
                ],
                [
                    'name'        => 'foundation::system.log-viewer',
                    'title'       => 'LogViewer',
                    'icon'        => 'fas fa-fw fa-clipboard-list',
                    'route'       => 'admin::foundation.system.log-viewer.index',
                    'roles'       => [Role::ADMINISTRATOR],
                    'permissions' => [
                        'admin::foundation.system.log-viewer.index',
                    ],
                ],
                [
                    'name'        => 'foundation::system.routes-viewer',
                    'title'       => 'Routes Viewer',
                    'icon'        => 'fas fa-fw fa-map-signs',
                    'route'       => 'admin::foundation.system.routes-viewer.index',
                    'roles'       => [Role::ADMINISTRATOR],
                    'permissions' => [
                        'admin::foundation.system.routes-viewer.index',
                    ],
                ],
            ],
        ],
    ],

];
