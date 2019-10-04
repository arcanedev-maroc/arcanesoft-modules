<?php

namespace Arcanesoft\Foundation\Providers;

use Arcanesoft\Foundation\Core\Providers\AuthServiceProvider as ServiceProvider;

/**
 * Class     AuthServiceProvider
 *
 * @package  Arcanesoft\Foundation\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AuthServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get policy's classes.
     *
     * @return array
     */
    public function policyClasses(): array
    {
        return $this->app->get('config')->get('arcanesoft.foundation.policies', []);
    }
}
