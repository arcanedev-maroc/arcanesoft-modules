<?php

namespace Arcanesoft\Blog\Policies;

use App\Models\User as AuthenticatedUser;
use Arcanesoft\Blog\Models\Author;
use Arcanesoft\Foundation\Core\Auth\Policy;

/**
 * Class     AuthorsPolicy
 *
 * @package  Arcanesoft\Blog\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AuthorsPolicy extends Policy
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
        return 'admin::blog.authors.';
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
        return [

            // admin::blog.authors.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'List all the authors',
                'description' => 'Ability to list all the authors',
            ]),

            // admin::blog.authors.metrics
            $this->makeAbility('metrics')->setMetas([
                'name'        => "List all the authors' metrics",
                'description' => "Ability to list all the authors' metrics",
            ]),

            // admin::blog.authors.show
            $this->makeAbility('show')->setMetas([
                'name'        => 'Show a author',
                'description' => "Ability to show the author's details",
            ]),

            // admin::blog.authors.create
            $this->makeAbility('create')->setMetas([
                'name'        => 'Create a new author',
                'description' => 'Ability to create a new author',
            ]),

            // admin::blog.authors.update
            $this->makeAbility('update')->setMetas([
                'name'        => 'Update a author',
                'description' => 'Ability to update a author',
            ]),

            // admin::blog.authors.delete
            $this->makeAbility('delete')->setMetas([
                'name'        => 'Delete a author',
                'description' => 'Ability to delete a author',
            ]),

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
     * @param  \App\Models\User                     $user
     * @param  \Arcanesoft\Blog\Models\Author|null  $model
     *
     * @return bool|void
     */
    public function update(AuthenticatedUser $user, ?Author $model)
    {
        //
    }

    /**
     * Allow to delete a author.
     *
     * @param  \App\Models\User                     $user
     * @param  \Arcanesoft\Blog\Models\Author|null  $model
     *
     * @return bool|void
     */
    public function delete(AuthenticatedUser $user, ?Author $model)
    {
        if ( ! is_null($model))
            return $model->isDeletable();
    }
}
