<?php namespace Arcanesoft\Blog\Repositories;

use Arcanesoft\Blog\Blog;
use Arcanesoft\Blog\Models\Post;
use Illuminate\Support\Str;

/**
 * Class     PostsRepository
 *
 * @package  Arcanesoft\Blog\Repositories
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PostsRepository
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the model instance.
     *
     * @return \Arcanesoft\Blog\Models\Post|\Illuminate\Database\Eloquent\Builder|mixed
     */
    public function model()
    {
        return Blog::makeModel('post');
    }

    /**
     * Get the query builder.
     *
     * @return \Arcanesoft\Blog\Models\Post|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->model()->newQuery();
    }


    /**
     * Create a new post.
     *
     * @param  array  $attributes
     *
     * @return \Arcanesoft\Blog\Models\Post
     */
    public function create(array $attributes)
    {
        $post = $this->model()
            ->forceFill([
                'uuid' => Str::uuid(),
            ])
            ->fill($attributes);

        $post->save();

        return $post;
    }

    /**
     * @param  \Arcanesoft\Blog\Models\Post  $post
     * @param  array                         $attributes
     *
     * @return \Arcanesoft\Blog\Models\Post
     */
    public function update(Post $post, array $attributes)
    {
        return $post;
    }

    /**
     * Delete a post.
     *
     * @param  \Arcanesoft\Blog\Models\Post  $post
     *
     * @return bool|null
     */
    public function delete(Post $post)
    {
        return $post->delete();
    }
}
