<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Providers;

use Arcanesoft\Foundation\System\ViewComposers;
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
        ViewComposers\ApplicationInfoComposer::class,
        ViewComposers\FoldersPermissionsComposer::class,
        ViewComposers\RequiredPhpExtensionsComposer::class,
    ];
}