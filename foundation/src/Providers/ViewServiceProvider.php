<?php namespace Arcanesoft\Foundation\Providers;

use Arcanesoft\Foundation\ViewComposers;
use Arcanesoft\Support\Providers\ViewServiceProvider as ServiceProvider;

/**
 * Class     ViewServiceProvider
 *
 * @package  Arcanesoft\Foundation\Providers
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

        // System
        ViewComposers\System\ApplicationInfoComposer::class,
        ViewComposers\System\FoldersPermissionsComposer::class,
        ViewComposers\System\RequiredPhpExtensionsComposer::class,
    ];
}
