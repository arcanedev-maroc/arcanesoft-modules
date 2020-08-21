<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Providers;

use Arcanesoft\Foundation\Support\Providers\ViewServiceProvider as ServiceProvider;

/**
 * Class     ViewServiceProvider
 *
 * @package  Arcanesoft\Foundation\Core\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ViewServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The view composers.
     *
     * @var array
     */
    protected $composers = [
        \Arcanesoft\Foundation\Core\Views\Composers\SidebarComposer::class,
        \Arcanesoft\Foundation\Core\Views\Composers\MetricsComposer::class,
        \Arcanesoft\Foundation\Core\Views\Composers\NotificationsComposer::class,
    ];
}
