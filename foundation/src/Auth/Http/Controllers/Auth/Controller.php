<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

/**
 * Class     Controller
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Controllers\Auth
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class Controller
{
    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;
}
