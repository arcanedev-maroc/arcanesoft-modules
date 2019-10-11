<?php

return [

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
            'users'               => 'users',
            'roles'               => 'roles',
            'permissions'         => 'permissions',
            'permissions-groups'  => 'permissions_groups',
            'password-resets'     => 'password_resets',
            'socialite-providers' => 'socialite_providers',
            'throttles'           => 'throttles',
            'role-user'           => 'role_user',
            'permission-role'     => 'permission_role',
        ],

        /* -----------------------------------------------------------------
         |  Models
         | -----------------------------------------------------------------
         */

        'models' => [
            'user'              => App\Models\User::class,
            'role'              => Arcanesoft\Foundation\Auth\Models\Role::class,
            'permission'        => Arcanesoft\Foundation\Auth\Models\Permission::class,
            'permissions-group' => Arcanesoft\Foundation\Auth\Models\PermissionsGroup::class,
            'password-resets'   => Arcanesoft\Foundation\Auth\Models\PasswordReset::class,
        ],

    ],

];
