<?php namespace Arcanesoft\Blog\Policies;

use App\Models\User as AuthenticatedUser;
use Arcanesoft\Blog\Models\Post;
use Arcanesoft\Support\Policies\Policy;

/**
 * Class     PostsPolicy
 *
 * @package  Arcanesoft\Blog\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PostsPolicy extends Policy
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the policy's prefix.
     *
     * @return string
     */
    public static function prefix(): string
    {
        return 'admin::blog.posts';
    }

    /**
     * Get the policy metas.
     *
     * @return array
     */
    public static function metas(): array
    {
        return [
            static::meta('index') // admin::blog.posts.index
                  ->name('List all the posts')
                  ->description('Ability to list all the posts'),

            static::meta('metrics') // admin::blog.posts.metrics
                  ->name("List all the posts' metrics")
                  ->description("Ability to list all the posts' metrics"),

            static::meta('show') // admin::blog.posts.show
                  ->name('Show a post')
                  ->description("Ability to show the post's details"),

            static::meta('create') // admin::blog.posts.create
                  ->name('Create a new post')
                  ->description('Ability to create a new post'),

            static::meta('update') // admin::blog.posts.update
                  ->name('Update a post')
                  ->description('Ability to update a post'),

            static::meta('delete') // admin::blog.posts.delete
                  ->name('Delete a post')
                  ->description('Ability to delete a post'),
        ];
    }

    /* -----------------------------------------------------------------
     |  Policies
     | -----------------------------------------------------------------
     */

    /**
     * Allow to list all the posts.
     *
     * @param  \App\Models\User|mixed  $user
     *
     * @return bool|void
     */
    public function index(AuthenticatedUser $user)
    {
        //
    }

    /**
     * Allow to list all the posts' metrics.
     *
     * @param  \App\Models\User|mixed  $user
     *
     * @return bool|void
     */
    public function metrics(AuthenticatedUser $user)
    {
        //
    }

    /**
     * Allow to show a post details.
     *
     * @param  \App\Models\User|mixed  $user
     *
     * @return bool|void
     */
    public function show(AuthenticatedUser $user)
    {
        //
    }

    /**
     * Allow to create a post.
     *
     * @param  \App\Models\User|mixed  $user
     *
     * @return bool|void
     */
    public function create(AuthenticatedUser $user)
    {
        //
    }

    /**
     * Allow to update a post.
     *
     * @param  \App\Models\User                   $user
     * @param  \Arcanesoft\Blog\Models\Post|null  $model
     *
     * @return bool|void
     */
    public function update(AuthenticatedUser $user, Post $model = null)
    {
        //
    }

    /**
     * Allow to delete a post.
     *
     * @param  \App\Models\User                   $user
     * @param  \Arcanesoft\Blog\Models\Post|null  $model
     *
     * @return bool|void
     */
    public function delete(AuthenticatedUser $user, Post $model = null)
    {
        if ( ! is_null($model))
            return $model->isDeletable();
    }
}
