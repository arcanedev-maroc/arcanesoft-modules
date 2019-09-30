<?php namespace Arcanesoft\Blog\Repositories;

use Arcanesoft\Blog\Blog;
use Arcanesoft\Blog\Models\Tag;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Class     TagsRepository
 *
 * @package  Arcanesoft\Blog\Repositories
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TagsRepository
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the model instance.
     *
     * @return \Arcanesoft\Blog\Models\Tag|\Illuminate\Database\Eloquent\Builder|mixed
     */
    public function model()
    {
        return Blog::makeModel('tag');
    }

    /**
     * Get the query builder.
     *
     * @return \Arcanesoft\Blog\Models\Tag|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->model()->newQuery();
    }

    /**
     * Create a new tag.
     *
     * @param  array  $attributes
     *
     * @return \Arcanesoft\Blog\Models\Tag
     */
    public function create(array $attributes)
    {
        $tag = $this->model()
            ->forceFill([
                'uuid' => Str::uuid(),
            ])
            ->fill($attributes);

        $tag->save();

        return $tag;
    }

    /**
     * Update the given tag.
     *
     * @param  \Arcanesoft\Blog\Models\Tag  $tag
     * @param  array                        $attributes
     *
     * @return bool
     */
    public function update(Tag $tag, array $attributes): bool
    {
        return $tag->update($attributes);
    }

    /**
     * Delete the given tag.
     *
     * @param  \Arcanesoft\Blog\Models\Tag  $tag
     *
     * @return bool|null
     */
    public function delete(Tag $tag)
    {
        return $tag->delete();
    }

    /**
     * Get the data for select input.
     *
     * @param  bool  $placeholder
     *
     * @return \Illuminate\Support\Collection
     */
    public function getSelectData(bool $placeholder = true)
    {
        return $this->query()
            ->pluck('name', 'uuid')
            ->when($placeholder, function (Collection $tags) {
                return $tags->prepend(__('-- Select a tag --'));
            })
            ->toBase();
    }
}
