<?php namespace Arcanesoft\Auth\Metrics\PasswordResets;

use Arcanedev\LaravelMetrics\Metrics\Trend;
use Arcanesoft\Auth\Models\PasswordReset;
use Illuminate\Http\Request;

/**
 * Class     PasswordResetsPerDay
 *
 * @package  Arcanesoft\Auth\Metrics\PasswordResets
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PasswordResetsPerDay extends Trend
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
        return $this->countByDays(PasswordReset::class);
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
