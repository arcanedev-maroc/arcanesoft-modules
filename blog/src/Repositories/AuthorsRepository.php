<?php namespace Arcanesoft\Blog\Repositories;

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
class AuthorsRepository
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the model instance.
     *
     * @return \Arcanesoft\Blog\Models\Author|\Illuminate\Database\Eloquent\Builder|mixed
     */
    public function model()
    {
        return Blog::makeModel('author');
    }

    /**
     * Get the query builder.
     *
     * @return \Arcanesoft\Blog\Models\Author|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->model()->newQuery();
    }

    /**
     * Create a new author.
     *
     * @param  array  $attributes
     *
     * @return \Arcanesoft\Blog\Models\Author
     */
    public function create(array $attributes)
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
     * @param  array                        $attributes
     *
     * @return bool
     */
    public function update(Author $author, array $attributes): bool
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
    public function delete(Author $author)
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
