<?php namespace Arcanesoft\Auth\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class     Activatable
 *
 * @package  Arcanesoft\Auth\Models\Concerns
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property-read  bool                             is_active
 * @property       \Illuminate\Support\Carbon|null  activated_at
 *
 * @method  static|\Illuminate\Database\Eloquent\Builder  activated()
 */
trait Activatable
{
    /* -----------------------------------------------------------------
     |  Scopes
     | -----------------------------------------------------------------
     */

    /**
     * Scope only activated records.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActivated(Builder $query)
    {
        return $query->whereNotNull('activated_at');
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the `is_active` attribute.
     *
     * @return bool
     */
    public function getIsActiveAttribute()
    {
        return $this->isActive();
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Activate/deactivate the model.
     *
     * @param  bool  $active
     * @param  bool  $save
     *
     * @return bool
     */
    protected function switchActive($active, $save = true)
    {
        $this->forceFill([
            'activated_at' => $active === true ? $this->freshTimestamp() : null,
        ]);

        return $save ? $this->save() : false;
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if the model is active.
     *
     * @return bool
     */
    public function isActive()
    {
        return ! is_null($this->activated_at);
    }
}
