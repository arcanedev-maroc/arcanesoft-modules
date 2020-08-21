<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Notifications\Authentication;

use Illuminate\Auth\Notifications\VerifyEmail as IlluminateVerifyEmail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\{Config, URL};

/**
 * Class     VerifyEmail
 *
 * @package  Arcanesoft\Foundation\Auth\Notifications\Authentication
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class VerifyEmail extends IlluminateVerifyEmail
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     *
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        $expiration = Carbon::now()->addMinutes((int) Config::get('auth.verification.expire', 60));

        return URL::temporarySignedRoute('auth::verification.verify', $expiration, [
            'id'   => $notifiable->getKey(),
            'hash' => sha1($notifiable->getEmailForVerification()),
        ]);
    }
}
