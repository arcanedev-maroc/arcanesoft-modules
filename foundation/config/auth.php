<?php

return [

    /* -----------------------------------------------------------------
     |  Authentication
     | -----------------------------------------------------------------
     */

    'authentication' => [
        'login' => [
            'enabled' => true,
        ],

        'register' => [
            'enabled' => true,
        ],
    ],

    /* -----------------------------------------------------------------
     |  Database
     | -----------------------------------------------------------------
     */

    'database' => [

        /* -----------------------------------------------------------------
         |  Connections
         | -----------------------------------------------------------------
         */

        'connection' => env('DB_CONNECTION', 'mysql'),

        /* -----------------------------------------------------------------
         |  Tables
         | -----------------------------------------------------------------
         */

        'prefix'     => 'auth_',

        'tables'     => [
            'admins'              => 'admins',
            'users'               => 'users',
            'roles'               => 'roles',
            'permissions'         => 'permissions',
            'permissions-groups'  => 'permissions_groups',
            'password-resets'     => 'password_resets',
            'socialite-providers' => 'socialite_providers',
            'throttles'           => 'throttles',
            'admin-role'          => 'admin_role',
            'permission-role'     => 'permission_role',
        ],

        /* -----------------------------------------------------------------
         |  Models
         | -----------------------------------------------------------------
         */

        'models' => [
            'user'               => App\Models\User::class,
            'admin'              => Arcanesoft\Foundation\Auth\Models\Admin::class,
            'role'               => Arcanesoft\Foundation\Auth\Models\Role::class,
            'permission'         => Arcanesoft\Foundation\Auth\Models\Permission::class,
            'permissions-group'  => Arcanesoft\Foundation\Auth\Models\PermissionsGroup::class,
            'password-resets'    => Arcanesoft\Foundation\Auth\Models\PasswordReset::class,
            'socialite-provider' => Arcanesoft\Foundation\Auth\Models\SocialiteProvider::class,
        ],

    ],

    /* -----------------------------------------------------------------
     |  Socialite
     | -----------------------------------------------------------------
     */

    'socialite' => [
        'enabled' => true,

        'drivers' => [
            'facebook',
            'github',
            'google',
            'twitter',
        ],
    ],

    /* -----------------------------------------------------------------
     |  Administrators
     | -----------------------------------------------------------------
     */

    'admins' => [
        'emails' => [
            'admin@example.com',
        ],
    ],

];
