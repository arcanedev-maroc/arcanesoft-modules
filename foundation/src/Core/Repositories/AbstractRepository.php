<?php

namespace Arcanesoft\Foundation\Core\Repositories;

use Illuminate\Support\Traits\ForwardsCalls;

/**
 * Class     AbstractRepository
 *
 * @package  Arcanesoft\Foundation\Core\Repositories
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
abstract class AbstractRepository implements RepositoryInterface
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use ForwardsCalls;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the model instance.
     *
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    abstract public static function model();

    /**
     * Get the query builder.
     *
     * @return \Illuminate\Database\Eloquent\Builder|mixed
     */
    public function query()
    {
        return static::model()->newQuery();
    }

    /* -----------------------------------------------------------------
     |  CRUD Methods
     | -----------------------------------------------------------------
     */

    /**
     * Execute the query as a "select" statement.
     *
     * @param  array  $columns
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]|mixed
     */
    public function all($columns = ['*'])
    {
        return $this->query()->get($columns);
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get count of all the records.
     *
     * @return int
     */
    public function count(): int
    {
        return $this->query()->count();
    }

    /**
     * Get a repository.
     *
     * @param  string  $repo
     *
     * @return \Arcanesoft\Foundation\Core\Repositories\RepositoryInterface|mixed
     */
    protected static function getRepository(string $repo): RepositoryInterface
    {
        return app()->make($repo);
    }

    /**
     * Pass dynamic methods onto the query instance.
     *
     * @param  string  $method
     * @param  array   $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->forwardCallTo(
            $this->query(), $method, $parameters
        );
    }
}