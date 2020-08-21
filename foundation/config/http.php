<?php

return [

    /* -----------------------------------------------------------------
     |  Middleware
     | -----------------------------------------------------------------
     */

    'middleware' => [
        'ajax'          => Arcanesoft\Foundation\Core\Http\Middleware\EnsureIsAjaxRequest::class,
        'authenticated' => Arcanesoft\Foundation\Core\Http\Middleware\EnsureIsAuthenticated::class,
        'activated'     => Arcanesoft\Foundation\Core\Http\Middleware\EnsureIsActive::class,
        'administrator' => Arcanesoft\Foundation\Core\Http\Middleware\EnsureIsAdmin::class,

        'arcanesoft'    => [
            'authenticated',
            'activated',
            'administrator',
        ],
    ],

];
