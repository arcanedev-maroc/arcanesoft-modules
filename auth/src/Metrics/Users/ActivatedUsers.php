<?php namespace Arcanesoft\Auth\Metrics\Users;

use Arcanedev\LaravelMetrics\Metrics\NullablePartition;
use Arcanesoft\Auth\Models\User;
use Illuminate\Http\Request;

/**
 * Class     ActivatedUsers
 *
 * @package  Arcanesoft\Auth\Metrics\Users
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ActivatedUsers extends NullablePartition
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
        return $this->count(User::class, 'activated_at')
                    ->labels([
                        0 => __('Deactivated'),
                        1 => __('Activated'),
                    ])
                    ->colors([
                        0 => '#6C757D',
                        1 => '#28A745',
                    ])
                    ->sort('desc');
    }
}
