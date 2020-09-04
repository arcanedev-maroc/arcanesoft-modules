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
     * Get the view composers.
     *
     * @return array
     */
    public function components(): array
    {
        return [
            PostsDatatable::NAME => PostsDatatable::class,
            TagsDatatable::NAME  => TagsDatatable::class,
        ];
    }
}
