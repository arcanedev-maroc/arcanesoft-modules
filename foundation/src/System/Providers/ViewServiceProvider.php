<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Providers;

use Arcanesoft\Foundation\System\Views\{Composers, Components};
use Arcanesoft\Foundation\Support\Providers\ViewServiceProvider as ServiceProvider;

/**
 * Class     ViewServiceProvider
 *
 * @package  Arcanesoft\Foundation\System\Providers
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
        Composers\ApplicationInfoComposer::class,
        Composers\FoldersPermissionsComposer::class,
        Composers\RequiredPhpExtensionsComposer::class,
    ];

    /**
     * The view components.
     *
     * @var array
     */
    protected $components = [
        Components\AbilitiesDatatable::NAME => Components\AbilitiesDatatable::class,
        Components\RoutesDatatable::NAME    => Components\RoutesDatatable::class,
    ];
}
