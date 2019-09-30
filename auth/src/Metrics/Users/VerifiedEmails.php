<?php namespace Arcanesoft\Auth\Metrics\Users;

use Arcanedev\LaravelMetrics\Metrics\NullablePartition;
use Arcanesoft\Auth\Models\User;
use Illuminate\Http\Request;

/**
 * Class     VerifiedEmails
 *
 * @package  Arcanesoft\Auth\Metrics\Users
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class VerifiedEmails extends NullablePartition
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
        return $this->count(User::class, 'email_verified_at')
                    ->labels([
                        0 => __('Not verified'),
                        1 => __('Verified'),
                    ])
                    ->colors([
                        0 => '#6C757D',
                        1 => '#007BFF',
                    ])
                    ->sort('desc');
    }
}
