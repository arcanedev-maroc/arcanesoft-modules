<?php namespace Arcanesoft\Blog\Policies;

use App\Models\User as AuthenticatedUser;
use Arcanesoft\Blog\Models\Tag;
use Arcanesoft\Support\Policies\Policy;

/**
 * Class     TagsPolicy
 *
 * @package  Arcanesoft\Blog\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TagsPolicy extends Policy
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
        return 'admin::blog.tags';
    }

    /**
     * Get the policy metas.
     *
     * @return array
     */
    public static function metas(): array
    {
        return [
            static::meta('index') // admin::blog.tags.index
                  ->name('List all the tags')
                  ->description('Ability to list all the tags'),

            static::meta('metrics') // admin::blog.tags.metrics
                  ->name("List all the tags' metrics")
                  ->description("Ability to list all the tags' metrics"),

            static::meta('show') // admin::blog.tags.show
                  ->name('Show a tag')
                  ->description("Ability to show the tag's details"),

            static::meta('create') // admin::blog.tags.create
                  ->name('Create a new tag')
                  ->description('Ability to create a new tag'),

            static::meta('update') // admin::blog.tags.update
                  ->name('Update a tag')
                  ->description('Ability to update a tag'),

            static::meta('delete') // admin::blog.tags.delete
                  ->name('Delete a tag')
                  ->description('Ability to delete a tag'),
        ];
    }

    /* -----------------------------------------------------------------
     |  Policies
     | -----------------------------------------------------------------
     */

    /**
     * Allow to list all the tags.
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
     * Allow to list all the tags' metrics.
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
     * Allow to show a tag details.
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
     * Allow to create a tag.
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
     * Allow to update a tag.
     *
     * @param  \App\Models\User                   $user
     * @param  \Arcanesoft\Blog\Models\Tag|null  $model
     *
     * @return bool|void
     */
    public function update(AuthenticatedUser $user, Tag $model = null)
    {
        //
    }

    /**
     * Allow to delete a tag.
     *
     * @param  \App\Models\User                   $user
     * @param  \Arcanesoft\Blog\Models\Tag|null  $model
     *
     * @return bool|void
     */
    public function delete(AuthenticatedUser $user, Tag $model = null)
    {
        if ( ! is_null($model))
            return $model->isDeletable();
    }
}
