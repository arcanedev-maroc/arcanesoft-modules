<?php

declare(strict_types=1);

namespace Arcanesoft\Blog\Providers;

use Arcanesoft\Blog\Views\Components\{PostsDatatable, TagsDatatable};
use Arcanesoft\Foundation\Support\Providers\ViewServiceProvider as ServiceProvider;

/**
 * Class     ViewServiceProvider
 *
 * @package  Arcanesoft\Blog\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ViewServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The view components.
     *
     * @var array
     */
    protected $components = [
        PostsDatatable::NAME => PostsDatatable::class,
        TagsDatatable::NAME  => TagsDatatable::class,
    ];
}
