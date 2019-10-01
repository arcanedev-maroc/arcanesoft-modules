<?php

namespace Arcanesoft\Foundation\ViewComposers\System;

use Arcanesoft\Foundation\Foundation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;

/**
 * Class     ApplicationInfoComposer
 *
 * @package  Arcanesoft\Foundation\ViewComposers\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ApplicationInfoComposer
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const VIEW = 'foundation::system._composers.application-info';

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Illuminate\Contracts\Foundation\Application */
    protected $app;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * ApplicationInfoComposer constructor.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Compose the view.
     *
     * @param  \Illuminate\Contracts\View\View  $view
     */
    public function compose(View $view)
    {
        $view->with('applicationInfo', [
            'url'                 => $this->getConfig('app.url'),
            'locale'              => strtoupper($this->getConfig('app.locale')),
            'timezone'            => $this->getConfig('app.timezone'),
            'debug_mode'          => (bool) $this->getConfig('app.debug', false),
            'maintenance_mode'    => $this->app->isDownForMaintenance(),
            'php_version'         => phpversion(),
            'laravel_version'     => $this->app->version(),
            'foundation_version'  => $this->app->get(Foundation::class)->version(),
            'database_connection' => $this->getConfig('database.default'),
            'cache_driver'        => $this->getConfig('cache.default'),
            'session_driver'      => $this->getConfig('session.driver')
        ]);
    }

    /**
     * Get the composed views.
     *
     * @return string|array
     */
    public static function views()
    {
        return self::VIEW;
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get a setting from the config.
     *
     * @param  string      $key
     * @param  mixed|null  $default
     *
     * @return mixed
     */
    protected function getConfig(string $key, $default = null)
    {
        return $this->app['config']->get($key, $default);
    }
}
