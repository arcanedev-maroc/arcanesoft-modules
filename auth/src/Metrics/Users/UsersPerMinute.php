<?php namespace Arcanesoft\Auth\Metrics\Users;

use Arcanedev\LaravelMetrics\Metrics\Trend;
use Arcanesoft\Auth\Models\User;
use Illuminate\Http\Request;

/**
 * Class     UsersPerMonth
 *
 * @package  Arcanesoft\Auth\Metrics\Users
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UsersPerMinute extends Trend
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
        return $this->countByMinutes(User::class);
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges(): array
    {
        return [
            60   => '60 Minutes',
            120  => '120 Minutes',
            180  => '180 Minutes',
            240  => '240 Minutes',
            480  => '480 Minutes',
            600  => '600 Minutes',
        ];
    }
}
