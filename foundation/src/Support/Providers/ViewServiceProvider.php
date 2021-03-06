<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Support\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class     ViewServiceProvider
 *
 * @package  Arcanesoft\Foundation\Support\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class ViewServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The view composers.
     *
     * @var string[]|array
     */
    protected $composers = [];

    /* -----------------------------------------------------------------
     |  Getters
     | -----------------------------------------------------------------
     */

    /**
     * Get the view composers.
     *
     * @return string[]|array
     */
    public function composers(): array
    {
        return $this->composers;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register bindings in the container.
     */
    public function boot(): void
    {
        $this->registerComposers();
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the view composers.
     */
    protected function registerComposers(): void
    {
        /** @var  \Illuminate\View\Factory  $factory */
        $factory = $this->app['view'];

        if ( ! empty($composers = $this->getRegisteredViewComposers())) {
            $factory->composers($composers);
        }
    }

    /**
     * Get the registered view composers.
     *
     * @return array
     */
    protected function getRegisteredViewComposers(): array
    {
        $composers = [];

        foreach ($this->composers() as $composer) {
            $composers[$composer] = $this->app->call("{$composer}@views");
        }

        return $composers;
    }
}
