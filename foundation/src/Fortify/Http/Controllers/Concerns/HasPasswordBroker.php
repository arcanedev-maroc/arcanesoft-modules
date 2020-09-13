<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Http\Controllers\Concerns;

use Illuminate\Contracts\Auth\{PasswordBroker, PasswordBrokerFactory};

/**
 * Trait     HasPasswordBroker
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait HasPasswordBroker
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the password broker.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    protected function broker(): PasswordBroker
    {
        return with(app('auth.password'), function (PasswordBrokerFactory $manager) {
            return $manager->broker($this->getBrokerDriver());
        });
    }

    /**
     * Get the password broker's driver.
     *
     * @return string|null
     */
    protected function getBrokerDriver(): ?string
    {
        return null;
    }
}
