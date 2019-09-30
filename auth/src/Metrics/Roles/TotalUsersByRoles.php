<?php namespace Arcanesoft\Auth\Metrics\Roles;

use Arcanedev\LaravelMetrics\Metrics\Partition;
use Arcanesoft\Auth\Models\Role;
use Illuminate\Http\Request;

/**
 * Class     TotalUsersByRoles
 *
 * @package  Arcanesoft\Auth\Metrics\Roles
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TotalUsersByRoles extends Partition
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
        $result = Role::query()->withCount(['users'])
            ->get()
            ->filter(function ($role) {
                return $role->users_count > 0;
            })
            ->pluck('users_count', 'name')
            ->toArray();

        return $this->result($result)->sort('desc');
    }
}
