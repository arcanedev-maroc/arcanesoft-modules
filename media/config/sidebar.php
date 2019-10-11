<?php

use Arcanesoft\Foundation\Auth\Models\Role;

return [
    'items' => [
        // Media
        [
            'name'        => 'foundation::media',
            'title'       => 'Media',
            'icon'        => 'far fa-fw fa-images',
            'route'       => 'admin::media.index',
            'roles'       => [Role::ADMINISTRATOR],
            'permissions' => [],
        ],
    ],
];
