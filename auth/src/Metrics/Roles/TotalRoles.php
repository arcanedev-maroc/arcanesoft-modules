<?php namespace Arcanesoft\Auth\Metrics\Roles;

use Arcanedev\LaravelMetrics\Metrics\Value;
use Arcanesoft\Auth\Models\Role;
use Illuminate\Http\Request;

/**
 * Class     TotalRoles
 *
 * @package  Arcanesoft\Auth\Metrics\Roles
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TotalRoles extends Value
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Calculate the metric.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Arcanedev\LaravelMetrics\Results\Result|mixed
     */
    public function calculate(Request $request)
    {
        return $this->count(Role::class);
    }
}
