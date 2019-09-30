<?php namespace Arcanesoft\Blog\Models\Presenters;

use Illuminate\Support\Str;

/**
 * Trait     AuthorPresenter
 *
 * @package  Arcanesoft\Blog\Models\Presenters
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait AuthorPresenter
{
    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Set the `slug` attribute.
     *
     * @param  string  $slug
     *
     * @return void
     */
    public function setSlugAttribute(string $slug)
    {
        $this->attributes['slug'] = Str::slug($slug);
    }
}
