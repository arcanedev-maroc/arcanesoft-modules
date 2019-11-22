<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Models\Pivots;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Class     AdminRole
 *
 * @package  Arcanesoft\Foundation\Auth\Models\Pivots
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AdminRole extends Pivot
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const UPDATED_AT = null;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'admin_id' => 'integer',
        'role_id'  => 'integer',
    ];
}
