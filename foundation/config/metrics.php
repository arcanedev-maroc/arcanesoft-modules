<?php

// TODO: Find an eloquent way to register and select metrics

return [

    /* -----------------------------------------------------------------
     |  Registered Metrics
     | -----------------------------------------------------------------
     */

    'registered' => [

        // Auth - Users
        Arcanesoft\Foundation\Auth\Metrics\Users\ActivatedUsers::class,
        Arcanesoft\Foundation\Auth\Metrics\Users\NewUsers::class,
        Arcanesoft\Foundation\Auth\Metrics\Users\TotalUsers::class,
        Arcanesoft\Foundation\Auth\Metrics\Users\UsersPerMinute::class,
        Arcanesoft\Foundation\Auth\Metrics\Users\UsersPerHour::class,
        Arcanesoft\Foundation\Auth\Metrics\Users\UsersPerDay::class,
        Arcanesoft\Foundation\Auth\Metrics\Users\UsersPerWeek::class,
        Arcanesoft\Foundation\Auth\Metrics\Users\UsersPerMonth::class,
        Arcanesoft\Foundation\Auth\Metrics\Users\VerifiedEmails::class,

        // Auth - Roles
        Arcanesoft\Foundation\Auth\Metrics\Roles\TotalRoles::class,
        Arcanesoft\Foundation\Auth\Metrics\Roles\TotalUsersByRoles::class,

        // Auth - Password Resets
        Arcanesoft\Foundation\Auth\Metrics\PasswordResets\PasswordResetsPerDay::class,
        Arcanesoft\Foundation\Auth\Metrics\PasswordResets\TotalPasswordResets::class,

        // System - LogViewer
        Arcanesoft\Foundation\System\Metrics\LogViewer\LogFilesCount::class,
        Arcanesoft\Foundation\System\Metrics\LogViewer\LogEntriesCountByLevel::class,

    ],

    /* -----------------------------------------------------------------
     |  Selected Metrics
     | -----------------------------------------------------------------
     */

    'selected' => [

        // Auth - Dashboard
        'auth-dashboard' => [
            'index' => [
                Arcanesoft\Foundation\Auth\Metrics\Users\TotalUsers::class,
                Arcanesoft\Foundation\Auth\Metrics\Users\UsersPerDay::class,
            ],
        ],

        // Auth - Users
        'auth-users' => [
            Arcanesoft\Foundation\Auth\Metrics\Users\TotalUsers::class,
            Arcanesoft\Foundation\Auth\Metrics\Users\NewUsers::class,
            Arcanesoft\Foundation\Auth\Metrics\Users\VerifiedEmails::class,
            Arcanesoft\Foundation\Auth\Metrics\Users\ActivatedUsers::class,
            Arcanesoft\Foundation\Auth\Metrics\Users\UsersPerDay::class,
        ],

        // Auth - Roles
        'auth-roles' => [
            Arcanesoft\Foundation\Auth\Metrics\Roles\TotalUsersByRoles::class,
            Arcanesoft\Foundation\Auth\Metrics\Roles\TotalRoles::class,
        ],

        // Auth - Password resets
        'auth-password-resets' => [
            Arcanesoft\Foundation\Auth\Metrics\PasswordResets\TotalPasswordResets::class,
            Arcanesoft\Foundation\Auth\Metrics\PasswordResets\PasswordResetsPerDay::class,
        ],
    ],

];
