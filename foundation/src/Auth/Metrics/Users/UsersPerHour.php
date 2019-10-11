<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Metrics\Users;

use Arcanedev\LaravelMetrics\Metrics\Trend;
use Arcanesoft\Foundation\Auth\Repositories\UsersRepository;
use Illuminate\Http\Request;

/**
 * Class     UsersPerMonth
 *
 * @package  Arcanesoft\Foundation\Auth\Metrics\Users
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
     * @param  \Illuminate\Http\Request                                  $request
     * @param  \Arcanesoft\Foundation\Auth\Repositories\UsersRepository  $repo
     *
     * @return \Arcanedev\LaravelMetrics\Results\Result|mixed
     */
    public function calculate(Request $request, UsersRepository $repo)
    {
        return $this->countByHours($repo->query());
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
