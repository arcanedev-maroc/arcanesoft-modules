<?php namespace Arcanesoft\Foundation\ViewComposers;

use Arcanedev\Html\Elements\Element;
use Arcanedev\LaravelMetrics\Contracts\Manager;
use Arcanedev\LaravelMetrics\Metrics\Metric;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class     MetricsComposer
 *
 * @package  Arcanesoft\Foundation\ViewComposers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MetricsComposer
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const VIEW = 'foundation::_partials.metrics';

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * @var \Arcanedev\LaravelMetrics\Contracts\Manager
     */
    private $manager;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * MetricsComposer constructor.
     *
     * @param  \Arcanedev\LaravelMetrics\Contracts\Manager  $manager
     */
    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     */
    public function compose(View $view)
    {
        $metrics = $this->manager->makeSelected()
            ->filter(function ($metric) {
                return $metric->authorizedToSee(request());
            })
            ->transform(function (Metric $metric) {
                return Element::withTag("{$metric->type()}-metric")->attribute(':metric', $metric->toJson());
            });

        $view->with('foundationMetrics', $metrics);
    }

    /**
     * Get the composer views.
     *
     * @return string|array
     */
    public static function views()
    {
        return static::VIEW;
    }
}
