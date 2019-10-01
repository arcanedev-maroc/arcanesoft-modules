<?php

namespace Arcanesoft\Auth\Repositories;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class     Respository
 *
 * @package  Arcanesoft\Auth\Repositories
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class Respository
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the model instance.
     *
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    abstract public function model();

    /**
     * Get the query builder.
     *
     * @return \Illuminate\Database\Eloquent\Builder|mixed
     */
    public function query()
    {
        return $this->model()->newQuery();
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
}