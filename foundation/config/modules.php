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
                Arcanesoft\Foundation\Core\Seeders\DatabaseSeeder::class,
                Arcanesoft\Foundation\Auth\Seeders\DatabaseSeeder::class,
                Arcanesoft\Foundation\System\Seeders\DatabaseSeeder::class,

                // External
                Arcanesoft\Blog\Seeders\DatabaseSeeder::class,
                Arcanesoft\Backups\Seeders\DatabaseSeeder::class,
                Arcanesoft\Media\Seeders\DatabaseSeeder::class,
//                Arcanesoft\Passport\Seeders\DatabaseSeeder::class,
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
