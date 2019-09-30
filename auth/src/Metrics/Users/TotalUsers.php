<?php namespace Arcanesoft\Auth\Metrics\Users;

use Arcanedev\LaravelMetrics\Metrics\Value;
use Arcanesoft\Auth\Models\User;
use Arcanesoft\Auth\Policies\UsersPolicy;
use Illuminate\Http\Request;

/**
 * Class     TotalUsers
 *
 * @package  Arcanesoft\Auth\Metrics\Users
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TotalUsers extends Value
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return mixed
     */
    public function calculate(Request $request)
    {
        return $this->count(User::class);
    }

    public function authorize(Request $request)
    {
        return $request->user()->can(UsersPolicy::ability('metrics'));
    }
}
