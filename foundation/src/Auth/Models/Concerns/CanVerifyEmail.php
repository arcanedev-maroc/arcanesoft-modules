<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Models\Concerns;

use Arcanesoft\Foundation\Auth\Notifications\Authentication\VerifyEmail as VerifyEmailNotification;

/**
 * Trait     CanVerifyEmail
 *
 * @package  Arcanesoft\Foundation\Auth\Models\Concerns
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait CanVerifyEmail
{
    /* -----------------------------------------------------------------
     |  Notifications
     | -----------------------------------------------------------------
     */

    /**
     * Send the email verification notification.
     */
    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerifyEmailNotification);
    }
}
