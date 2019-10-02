<?php namespace Arcanesoft\Blog\Policies;

use App\Models\User as AuthenticatedUser;
use Arcanesoft\Blog\Models\Tag;

/**
 * Class     TagsPolicy
 *
 * @package  Arcanesoft\Blog\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TagsPolicy extends AbstractPolicy
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Ability's prefix.
     *
     * @var string|null
     */
    protected $prefix = 'admin::blog.tags.';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the policy's abilities.
     *
     * @return \Arcanesoft\Support\Policies\Ability[]|array
     */
    public function abilities(): array
    {
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

            // admin::blog.tags.show
            $this->makeAbility('show')->setMetas([
                'name'        => 'Show a tag',
                'description' => "Ability to show the tag's details",
            ]),

            // admin::blog.tags.create
            $this->makeAbility('create')->setMetas([
                'name'        => 'Create a new tag',
                'description' => 'Ability to create a new tag',
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
    public function update(AuthenticatedUser $user, ?Tag $model)
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
    public function delete(AuthenticatedUser $user, ?Tag $model)
    {
        if ( ! is_null($model))
            return $model->isDeletable();
    }
}
