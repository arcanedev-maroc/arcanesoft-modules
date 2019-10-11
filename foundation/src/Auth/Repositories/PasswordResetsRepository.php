<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Repositories;

use Arcanesoft\Foundation\Auth\Auth;

/**
 * Class     PasswordResetsRepository
 *
 * @package  Arcanesoft\Foundation\Auth\Repositories
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @mixin  \Arcanesoft\Foundation\Auth\Models\PasswordReset
 */
class PasswordResetsRepository extends AbstractRepository
{
    /* -----------------------------------------------------------------
     |  Query Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the permission instance.
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Permission|mixed
     */
    public static function model()
    {
        return Auth::makeModel('password-resets');
    }
}
