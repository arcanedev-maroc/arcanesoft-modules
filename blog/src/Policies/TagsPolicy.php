<?php

namespace Arcanesoft\Blog\Policies;

use Arcanesoft\Blog\Models\Tag;
use ArcanesoftFoundation\Auth\ModelsUser as AuthenticatedUser;

/**
 * Class     TagsPolicy
 *
 * @package  Arcanesoft\Blog\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TagsPolicy extends AbstractPolicy
{
    /* -----------------------------------------------------------------
     |  Getters
     | -----------------------------------------------------------------
     */

    /**
     * Get the ability's prefix.
     *
     * @return string
     */
    protected static function prefix(): string
    {
        return 'admin::blog.tags.';
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
            'category' => 'Tags',
        ]);

        return [

            // admin::blog.tags.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'List all the tags',
                'description' => 'Ability to list all the tags',
            ]),

            // admin::blog.tags.metrics
            $this->makeAbility('metrics')->setMetas([
                'name'        => "List all the tags' metrics",
                'description' => "Ability to list all the tags' metrics",
            ]),

            // admin::blog.tags.create
            $this->makeAbility('create')->setMetas([
                'name'        => 'Create a new tag',
                'description' => 'Ability to create a new tag',
            ]),

            // admin::blog.tags.show
            $this->makeAbility('show')->setMetas([
                'name'        => 'Show a tag',
                'description' => "Ability to show the tag's details",
            ]),

            // admin::blog.tags.update
            $this->makeAbility('update')->setMetas([
                'name'        => 'Update a tag',
                'description' => 'Ability to update a tag',
            ]),

            // admin::blog.tags.delete
            $this->makeAbility('delete')->setMetas([
                'name'        => 'Delete a tag',
                'description' => 'Ability to delete a tag',
            ]),

        ];
    }

    /* -----------------------------------------------------------------
     |  Abilities
     | -----------------------------------------------------------------
     */

    /**
     * Allow to list all the tags.
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
     * Allow to list all the tags' metrics.
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
     * Allow to create a tag.
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
     * Allow to show a tag details.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User|mixed  $user
     * @param  \Arcanesoft\Blog\Models\Tag|mixed|null         $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function show(AuthenticatedUser $user, Tag $model = null)
    {
        //
    }

    /**
     * Allow to update a tag.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User|mixed  $user
     * @param  \Arcanesoft\Blog\Models\Tag|mixed|null         $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function update(AuthenticatedUser $user, Tag $model = null)
    {
        //
    }

    /**
     * Allow to delete a tag.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User|mixed  $user
     * @param  \Arcanesoft\Blog\Models\Tag|mixed|null         $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function delete(AuthenticatedUser $user, Tag $model = null)
    {
        if ( ! is_null($model))
            return $model->isDeletable();
    }
}
