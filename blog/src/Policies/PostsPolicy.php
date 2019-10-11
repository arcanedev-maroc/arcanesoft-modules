<?php

declare(strict_types=1);

namespace Arcanesoft\Blog\Policies;

use Arcanesoft\Blog\Models\Post;
use ArcanesoftFoundation\AuthModelsUser as AuthenticatedUser;

/**
 * Class     PostsPolicy
 *
 * @package  Arcanesoft\Blog\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PostsPolicy extends AbstractPolicy
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Get the ability's prefix.
     *
     * @return string
     */
    protected static function prefix(): string
    {
        return 'admin::blog.posts.';
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the policy's abilities.
     *
     * @return \Arcanedev\LaravelPolicies\Ability[]|iterable
     */
    public function abilities(): iterable
    {
        $this->setMetas([
            'category' => 'Posts',
        ]);

        return [

            // admin::blog.posts.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'List all the posts',
                'description' => 'Ability to list all the posts',
            ]),

            // admin::blog.posts.metrics
            $this->makeAbility('metrics')->setMetas([
                'name'        => "List all the posts' metrics",
                'description' => "Ability to list all the posts' metrics",
            ]),

            // admin::blog.posts.create
            $this->makeAbility('create')->setMetas([
                'name'        => 'Create a new post',
                'description' => 'Ability to create a new post',
            ]),

            // admin::blog.posts.show
            $this->makeAbility('show')->setMetas([
                'name'        => 'Show a post',
                'description' => "Ability to show the post's details",
            ]),

            // admin::blog.posts.update
            $this->makeAbility('update')->setMetas([
                'name'        => 'Update a post',
                'description' => 'Ability to update a post',
            ]),

            // admin::blog.posts.delete
            $this->makeAbility('delete')->setMetas([
                'name'        => 'Delete a post',
                'description' => 'Ability to delete a post',
            ]),

        ];
    }

    /* -----------------------------------------------------------------
     |  Policies
     | -----------------------------------------------------------------
     */

    /**
     * Allow to list all the posts.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User|mixed  $user
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function index(AuthenticatedUser $user)
    {
        //
    }

    /**
     * Allow to list all the posts' metrics.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User|mixed  $user
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function metrics(AuthenticatedUser $user)
    {
        //
    }

    /**
     * Allow to create a post.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User|mixed  $user
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function create(AuthenticatedUser $user)
    {
        //
    }

    /**
     * Allow to show a post details.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User|mixed  $user
     * @param  \Arcanesoft\Blog\Models\Post|mixed|null        $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function show(AuthenticatedUser $user, Post $model = null)
    {
        //
    }

    /**
     * Allow to update a post.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User|mixed  $user
     * @param  \Arcanesoft\Blog\Models\Post|mixed|null        $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function update(AuthenticatedUser $user, Post $model = null)
    {
        //
    }

    /**
     * Allow to delete a post.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User|mixed  $user
     * @param  \Arcanesoft\Blog\Models\Post|mixed|null        $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function delete(AuthenticatedUser $user, Post $model = null)
    {
        if ( ! is_null($model))
            return $model->isDeletable();
    }
}
