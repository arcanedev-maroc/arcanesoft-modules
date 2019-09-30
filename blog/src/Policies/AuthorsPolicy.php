<?php namespace Arcanesoft\Blog\Policies;

use App\Models\User as AuthenticatedUser;
use Arcanesoft\Blog\Models\Author;
use Arcanesoft\Support\Policies\Policy;

/**
 * Class     AuthorsPolicy
 *
 * @package  Arcanesoft\Blog\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AuthorsPolicy extends Policy
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
        return 'admin::blog.authors';
    }

    /**
     * Get the policy metas.
     *
     * @return array
     */
    public static function metas(): array
    {
        return [
            static::meta('index') // admin::blog.authors.index
                  ->name('List all the authors')
                  ->description('Ability to list all the authors'),

            static::meta('metrics') // admin::blog.authors.metrics
                  ->name("List all the authors' metrics")
                  ->description("Ability to list all the authors' metrics"),

            static::meta('show') // admin::blog.authors.show
                  ->name('Show a author')
                  ->description("Ability to show the author's details"),

            static::meta('create') // admin::blog.authors.create
                  ->name('Create a new author')
                  ->description('Ability to create a new author'),

            static::meta('update') // admin::blog.authors.update
                  ->name('Update a author')
                  ->description('Ability to update a author'),

            static::meta('delete') // admin::blog.authors.delete
                  ->name('Delete a author')
                  ->description('Ability to delete a author'),
        ];
    }

    /* -----------------------------------------------------------------
     |  Policies
     | -----------------------------------------------------------------
     */

    /**
     * Allow to list all the authors.
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
     * Allow to list all the authors' metrics.
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
     * Allow to show a author details.
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
     * Allow to create a author.
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
     * Allow to update a author.
     *
     * @param  \App\Models\User                   $user
     * @param  \Arcanesoft\Blog\Models\Author|null  $model
     *
     * @return bool|void
     */
    public function update(AuthenticatedUser $user, Author $model = null)
    {
        //
    }

    /**
     * Allow to delete a author.
     *
     * @param  \App\Models\User                   $user
     * @param  \Arcanesoft\Blog\Models\Author|null  $model
     *
     * @return bool|void
     */
    public function delete(AuthenticatedUser $user, Author $model = null)
    {
        if ( ! is_null($model))
            return $model->isDeletable();
    }
}
