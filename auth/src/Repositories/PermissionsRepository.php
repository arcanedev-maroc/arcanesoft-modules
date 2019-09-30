<?php namespace Arcanesoft\Auth\Repositories;

use Arcanesoft\Auth\Auth;

/**
 * Class     PermissionsRepository
 *
 * @package  Arcanesoft\Auth\Repositories
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PermissionsRepository
{
    /* -----------------------------------------------------------------
     |  Query Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the permission instance.
     *
     * @return \Arcanesoft\Auth\Models\Permission|mixed
     */
    public function model()
    {
        return Auth::makeModel('permission');
    }

    /**
     * Get the query builder.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->model()->newQuery();
    }

    /**
     * Get all the permissions.
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->query()->get();
    }
}
