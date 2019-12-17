<?php

declare(strict_types=1);

namespace Arcanesoft\Blog\Repositories;

use Arcanesoft\Blog\Blog;
use Arcanesoft\Blog\Models\Post;
use Illuminate\Support\Str;

/**
 * Class     PostsRepository
 *
 * @package  Arcanesoft\Blog\Repositories
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PostsRepository extends AbstractRepository
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the model FQN class.
     *
     * @return string
     */
    public static function modelClass(): string
    {
        return Blog::model('post');
    }

    /**
     * Create a new post.
     *
     * @param  array  $attributes
     *
     * @return \Arcanesoft\Blog\Models\Post|mixed
     */
    public function createOne(array $attributes)
    {
        $post = $this->model()->forceFill([
            'uuid' => Str::uuid(),
        ])->fill($attributes);

        $post->save();

        return $post;
    }

    /**
     * Update the given post.
     *
     * @param  \Arcanesoft\Blog\Models\Post  $post
     * @param  array                         $attributes
     *
     * @return bool
     */
    public function updateOne(Post $post, array $attributes)
    {
        return $post->update($attributes);
    }

    /**
     * Delete a post.
     *
     * @param  \Arcanesoft\Blog\Models\Post  $post
     *
     * @return bool|null
     */
    public function deleteOne(Post $post)
    {
        return $post->delete();
    }
}
