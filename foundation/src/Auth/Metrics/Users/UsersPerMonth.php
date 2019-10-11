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
class UsersPerMonth extends Trend
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
        return $this->countByMonths($repo->query());
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges(): array
    {
        return [
            3  => '3 Months',
            6  => '6 Months',
            9  => '9 Months',
            12 => '12 Months',
        ];
    }
}
