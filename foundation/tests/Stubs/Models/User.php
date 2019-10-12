<?php

namespace Arcanesoft\Foundation\Tests\Stubs\Models;

use Arcanesoft\Foundation\Auth\Models\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

/**
 * Class     User
 *
 * @package  Arcanesoft\Foundation\Tests\Stubs\Models
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class User extends Authenticatable implements MustVerifyEmail
{
    //
}