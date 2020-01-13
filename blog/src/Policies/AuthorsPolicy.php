<?php

declare(strict_types=1);

namespace Arcanesoft\Blog\Policies;

use Arcanesoft\Blog\Models\Author;
use Arcanesoft\Foundation\Auth\Models\Admin;

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
        $this->setMetas([
            'category' => 'Authors',
        ]);

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

            // admin::blog.authors.create
            $this->makeAbility('create')->setMetas([
                'name'        => 'Create a new author',
                'description' => 'Ability to create a new author',
            ]),

            // admin::blog.authors.show
            $this->makeAbility('show')->setMetas([
                'name'        => 'Show a author',
                'description' => "Ability to show the author's details",
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
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin|mixed  $admin
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function index(Admin $user)
    {
        //
    }

    /**
     * Allow to list all the authors' metrics.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin|mixed  $admin
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function metrics(Admin $user)
    {
        //
    }

    /**
     * Allow to create a author.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin|mixed  $admin
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function create(Admin $user)
    {
        //
    }

    /**
     * Allow to show a author details.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin|mixed  $admin
     * @param  \Arcanesoft\Blog\Models\Author|mixed|null       $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function show(Admin $user, Author $model = null)
    {
        //
    }

    /**
     * Allow to update a author.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin|mixed  $admin
     * @param  \Arcanesoft\Blog\Models\Author|mixed|null       $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function update(Admin $user, Author $model = null)
    {
        //
    }

    /**
     * Allow to delete a author.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin|mixed  $admin
     * @param  \Arcanesoft\Blog\Models\Author|mixed|null       $model
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function delete(Admin $user, Author $model = null)
    {
        if ( ! is_null($model))
            return $model->isDeletable();
    }
}
