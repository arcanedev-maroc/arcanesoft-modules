<?php

use Arcanesoft\Blog\Policies;

return [

    /* -----------------------------------------------------------------
     |  Policies
     | -----------------------------------------------------------------
     */

    Policies\DashboardPolicy::class => [
        'category' => 'Dashboard',
    ],

    Policies\AuthorsPolicy::class => [
        'category' => 'Authors',
    ],

    Policies\PostsPolicy::class => [
        'category' => 'Posts',
    ],

    Policies\TagsPolicy::class => [
        'category' => 'Tags',
    ],

];
