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

            'login-after-registered' => true,
        ],

        'socialite' => [
            'enabled' => false,

            'drivers' => [
                'facebook',
                'github',
                'google',
                'twitter',
            ],
        ],
    ],

    /* -----------------------------------------------------------------
     |  Database
     | -----------------------------------------------------------------
     */

    'database' => [

        // Connections
        // ----------------------------------

        'connection' => env('DB_CONNECTION', 'mysql'),

        // Tables
        // ----------------------------------

        'prefix'     => 'auth_',

        'tables'     => [
            'administrators'      => 'administrators',
            'users'               => 'users',
            'roles'               => 'roles',
            'permissions'         => 'permissions',
            'permissions-groups'  => 'permissions_groups',
            'password-resets'     => 'password_resets',
            'socialite-providers' => 'socialite_providers',
            'throttles'           => 'throttles',
            'administrator-role'  => 'administrator_role',
            'permission-role'     => 'permission_role',
        ],

         // Models
         // ----------------------------------

        'models' => [
            'user'               => App\Models\User::class,
            'administrator'      => Arcanesoft\Foundation\Auth\Models\Administrator::class,
            'role'               => Arcanesoft\Foundation\Auth\Models\Role::class,
            'permission'         => Arcanesoft\Foundation\Auth\Models\Permission::class,
            'permissions-group'  => Arcanesoft\Foundation\Auth\Models\PermissionsGroup::class,
            'password-resets'    => Arcanesoft\Foundation\Auth\Models\PasswordReset::class,
            'socialite-provider' => Arcanesoft\Foundation\Auth\Models\SocialiteProvider::class,
        ],

    ],

    /* -----------------------------------------------------------------
     |  Administrators
     | -----------------------------------------------------------------
     */

    'administrators' => [
        'emails' => [
            'admin@example.com',
        ],
    ],

];
