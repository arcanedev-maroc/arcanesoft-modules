<?php

use Arcanesoft\Foundation\Auth\Models\Role;

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
        'arcanesoft.media.sidebar.items',
        'arcanesoft.passport.sidebar.items',

        // Authorization
        [
            'name'        => 'auth::authorization',
            'title'       => 'Authorization',
            'icon'        => 'fas fa-fw fa-key',
            'roles'       => [],
            'permissions' => [],
            'children'    => [
                [
                    'name'        => 'auth::authorization.dashboard',
                    'title'       => 'Statistics',
                    'icon'        => 'fas fa-fw fa-tachometer-alt',
                    'route'       => 'admin::auth.index',
                    'roles'       => [
                        Role::ADMINISTRATOR,
                        'auth-moderator',
                    ],
                    'permissions' => [],
                ],
                [
                    'name'        => 'auth::authorization.users',
                    'title'       => 'Users',
                    'icon'        => 'fas fa-fw fa-users',
                    'route'       => 'admin::auth.users.index',
                    'roles'       => [
                        Role::ADMINISTRATOR,
                        'auth-moderator',
                    ],
                    'permissions' => [],
                ],
                [
                    'name'        => 'auth::authorization.roles',
                    'title'       => 'Roles',
                    'icon'        => 'fas fa-fw fa-user-tag',
                    'route'       => 'admin::auth.roles.index',
                    'roles'       => [
                        Role::ADMINISTRATOR,
                        'auth-moderator',
                    ],
                    'permissions' => [],
                ],
                [
                    'name'        => 'auth::authorization.permissions',
                    'title'       => 'Permissions',
                    'icon'        => 'fas fa-fw fa-shield-alt',
                    'route'       => 'admin::auth.permissions.index',
                    'roles'       => [
                        Role::ADMINISTRATOR,
                        'auth-moderator',
                    ],
                    'permissions' => [],
                ],
                [
                    'name'        => 'auth::authorization.password-resets',
                    'title'       => 'Password Resets',
                    'icon'        => 'fas fa-fw fa-sync',
                    'route'       => 'admin::auth.password-resets.index',
                    'roles'       => [
                        Role::ADMINISTRATOR,
                        'auth-moderator',
                    ],
                    'permissions' => [],
                ],
            ],
        ],

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
                    'route'       => 'admin::system.index',
                    'roles'       => [Role::ADMINISTRATOR],
                    'permissions' => [
                        'admin::system.index',
                    ],
                ],
                [
                    'name'        => 'foundation::system.log-viewer',
                    'title'       => 'LogViewer',
                    'icon'        => 'fas fa-fw fa-clipboard-list',
                    'route'       => 'admin::system.log-viewer.index',
                    'roles'       => [Role::ADMINISTRATOR],
                    'permissions' => [
                        'admin::system.log-viewer.index',
                    ],
                ],
                [
                    'name'        => 'foundation::system.routes-viewer',
                    'title'       => 'Routes Viewer',
                    'icon'        => 'fas fa-fw fa-map-signs',
                    'route'       => 'admin::system.routes-viewer.index',
                    'roles'       => [Role::ADMINISTRATOR],
                    'permissions' => [
                        'admin::system.routes-viewer.index',
                    ],
                ],
            ],
        ],

        'arcanesoft.backups.sidebar.items',
    ],

];
