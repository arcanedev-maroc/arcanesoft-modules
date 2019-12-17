<?php

declare(strict_types=1);

namespace Arcanesoft\Blog\Repositories;

use Arcanesoft\Auth\Repositories\UsersRepository;
use Arcanesoft\Blog\Blog;
use Arcanesoft\Blog\Models\Author;
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
        return Blog::makeModel('author');
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
        $author = $this->model()
            ->forceFill([
                'uuid'    => Str::uuid(),
                'user_id' => $this->createUser($attributes)->getKey()
            ])
            ->fill($attributes);

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

    /**
     * Create a new user.
     *
     * @param  array  $attributes
     *
     * @return \App\Models\User|\Arcanesoft\Auth\Models\User|mixed
     */
    private function createUser(array $attributes)
    {
        $attributes['roles'] = ['blog-author'];

        return (new UsersRepository)->create($attributes);
    }
}
