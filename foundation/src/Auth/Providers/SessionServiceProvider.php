<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Providers;

use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Auth\Session\ArcanesoftSessionHandler;
use Illuminate\Session\DatabaseSessionHandler;
use Illuminate\Support\ServiceProvider;

/**
 * Class     SessionServiceProvider
 *
 * @package  Arcanesoft\Foundation\Auth\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SessionServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Boot the service provider.
     */
    public function register(): void
    {
        /** @var  \Illuminate\Session\SessionManager  $session */
        $session = $this->app['session'];

        $session->extend('arcanesoft', function ($app) {
            $model = Auth::makeModel('session');

            $lifetime = $app['config']['session.lifetime'];

            return new ArcanesoftSessionHandler($model->getConnection(), $model->getTable(), $lifetime, $app);
        });
    }
}
