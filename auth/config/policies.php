<?php

use Arcanesoft\Auth\Policies;

return [

    /* -----------------------------------------------------------------
     |  Policies
     | -----------------------------------------------------------------
     */

    Policies\DashboardPolicy::class => [
        'category' => 'Dashboard',
    ],

    Policies\UsersPolicy::class => [
        'category' => 'Users',
    ],

    Policies\RolesPolicy::class => [
        'category' => 'Roles',
    ],

    Policies\PermissionsPolicy::class => [
        'category' => 'Permissions',
    ],

    Policies\PasswordResetsPolicy::class => [
        'category' => 'Password Resets',
    ],

];
