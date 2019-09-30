<?php namespace Arcanesoft\Auth\Metrics\PasswordResets;

use Arcanedev\LaravelMetrics\Metrics\Value;
use Arcanesoft\Auth\Models\PasswordReset;
use Arcanesoft\Auth\Policies\PasswordResetsPolicy;
use Illuminate\Http\Request;

/**
 * Class     TotalPasswordResets
 *
 * @package  Arcanesoft\Auth\Metrics\PasswordResets
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TotalPasswordResets extends Value
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
        return $this->result(PasswordReset::query()->count());
    }

    public function authorize(Request $request)
    {
        return $request->user()->can(PasswordResetsPolicy::ability('metrics'));
    }
}
