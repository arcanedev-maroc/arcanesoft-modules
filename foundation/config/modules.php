<?php

return [

    /* -----------------------------------------------------------------
     |  Service Providers
     | -----------------------------------------------------------------
     */

    'commands' => [
        'install'   => [
            Arcanesoft\Blog\Console\InstallCommand::class,
            Arcanesoft\Backups\Console\InstallCommand::class,
            Arcanesoft\Media\Console\InstallCommand::class,
            Arcanesoft\Passport\Console\InstallCommand::class,
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
