<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Rules\Users;

use Arcanesoft\Foundation\Auth\Auth;
use Illuminate\Validation\Rules\Unique;

/**
 * Class     UserEmailRule
 *
 * @package  Arcanesoft\Foundation\Auth\Rules\Users
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UserEmailRule
{
    /* -----------------------------------------------------------------
     |  Rules
     | -----------------------------------------------------------------
     */

    /**
     * Get the unique email rule.
     *
     * @return \Illuminate\Validation\Rules\Unique
     */
    public static function unique()
    {
        return new Unique(Auth::table('users'), 'email');
    }
}
