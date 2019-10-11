<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Providers;

use Arcanesoft\Foundation\Core\ViewComposers;
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
        ViewComposers\SidebarComposer::class,
        ViewComposers\MetricsComposer::class,
        ViewComposers\NotificationsComposer::class,
    ];
}
