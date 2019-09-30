<?php namespace Arcanesoft\Support\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

/**
 * Class     ViewServiceProvider
 *
 * @package  Arcanesoft\Support\Providers
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
     * @var array
     */
    protected $composers = [];

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerComposers();
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the view composers.
     *
     * @return array
     */
    protected function registerComposers()
    {
        /** @var  \Illuminate\View\Factory  $factory */
        $factory = $this->app['view'];

        return $factory->composers(
            Collection::make($this->composers)->mapWithKeys(function ($composer) {
                return [
                    $composer => Arr::wrap($composer::views())
                ];
            })->toArray()
        );
    }
}
