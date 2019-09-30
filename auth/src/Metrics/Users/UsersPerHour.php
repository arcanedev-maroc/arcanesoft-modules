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
class UsersPerHour extends Trend
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
        return $this->countByHours(User::class);
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges(): array
    {
        return [
            6   => '6 Hours',
            12  => '12 Hours',
            18  => '18 Hours',
            24  => '24 Hours',
            48  => '48 Hours',
            100 => '100 Hours',
        ];
    }
}
