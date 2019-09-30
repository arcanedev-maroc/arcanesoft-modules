<?php namespace Arcanesoft\Auth\Metrics\Users;

use Arcanedev\LaravelMetrics\Metrics\Trend;
use Arcanesoft\Auth\Models\User;
use Illuminate\Http\Request;

/**
 * Class     UsersPerDay
 *
 * @package  Arcanesoft\Auth\Metrics\Users
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UsersPerDay extends Trend
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Calculate the value of the metric.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function calculate(Request $request)
    {
        return $this->countByDays(User::class);
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges(): array
    {
        return [
            7  => '7 Days',
            14 => '14 Days',
            30 => '30 Days',
        ];
    }
}
