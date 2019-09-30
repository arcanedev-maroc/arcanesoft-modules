<?php namespace Arcanesoft\Auth\Metrics\Users;

use Arcanedev\LaravelMetrics\Metrics\RangedValue;
use Arcanesoft\Auth\Models\User;
use Illuminate\Http\Request;

/**
 * Class     NewUsers
 *
 * @package  Arcanesoft\Auth\Metrics\Users
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class NewUsers extends RangedValue
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

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges(): array
    {
        return [
            1   => __('Today'),
            7   => __('7 Days'),
            30  => __('30 Days'),
            60  => __('60 Days'),
            365 => __('365 Days'),
        ];
    }
}
