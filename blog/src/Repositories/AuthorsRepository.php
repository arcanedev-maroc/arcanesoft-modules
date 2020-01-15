<?php

declare(strict_types=1);

namespace Arcanesoft\Blog\Repositories;

use Arcanesoft\Auth\Repositories\UsersRepository;
use Arcanesoft\Blog\Blog;
use Arcanesoft\Blog\Models\Author;
use Arcanesoft\Foundation\Auth\Repositories\AdministratorsRepository;
use Illuminate\Support\Str;

/**
 * Class     AuthorsRepository
 *
 * @package  Arcanesoft\Blog\Repositories
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AuthorsRepository extends AbstractRepository
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
        return Blog::model('author');
    }

    /**
     * Create a new author.
     *
     * @param  array  $attributes
     *
     * @return \Arcanesoft\Blog\Models\Author
     */
    public function createOne(array $attributes)
    {
        /** @var  \Arcanesoft\Blog\Models\Author  $author */
        $author = $this->model()->fill($attributes)->forceFill([
            'uuid' => Str::uuid(),
        ]);

        $author->creator()->associate($this->createBlogModerator($attributes));

        $author->save();

        return $author;
    }

    /**
     * Update the given author.
     *
     * @param  \Arcanesoft\Blog\Models\Author  $author
     * @param  array                           $attributes
     *
     * @return bool
     */
    public function updateOne(Author $author, array $attributes): bool
    {
        return $author->update($attributes);
    }

    /**
     * Delete the given author.
     *
     * @param  \Arcanesoft\Blog\Models\Author  $author
     *
     * @return bool|null
     */
    public function deleteOne(Author $author)
    {
        return $author->delete();
    }

    /* -----------------------------------------------------------------
     |  Relationship's Methods
     | -----------------------------------------------------------------
     */

    /**
     * Create a new blog moderator.
     *
     * @param  array  $attributes
     *
     * @return \Arcanesoft\Foundation\Auth\Models\Admin|mixed
     */
    protected function createBlogModerator(array $attributes)
    {
        $attributes['roles'] = ['blog-author'];

        return $this->makeRepository(AdministratorsRepository::class)
            ->createOne($attributes);
    }
}
