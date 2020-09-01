<?php

return [

    /* -----------------------------------------------------------------
     |  Service Providers
     | -----------------------------------------------------------------
     */

    'providers' => [
        Arcanesoft\Media\MediaServiceProvider::class,
        Arcanesoft\Blog\BlogServiceProvider::class,
    ],

    'commands' => [
        'setup'   => [

            'seeders' => [
                // Foundation
                Arcanesoft\Foundation\Core\Database\DatabaseSeeder::class,
                Arcanesoft\Foundation\Auth\Database\DatabaseSeeder::class,
                Arcanesoft\Foundation\System\Database\DatabaseSeeder::class,

                // External
                Arcanesoft\Blog\Database\DatabaseSeeder::class,
                Arcanesoft\Backups\Database\DatabaseSeeder::class,
                Arcanesoft\Media\Database\DatabaseSeeder::class,
                Arcanesoft\Passport\Database\DatabaseSeeder::class,
            ],

        ],

        'publish' => [
            'tags' => [
                'arcanesoft-assets',
                'arcanesoft-config',
                'arcanesoft-translations',
                'arcanesoft-views',
            ],
        ],

    ],

];
