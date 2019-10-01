<?php

namespace Arcanesoft\Auth\Repositories;

use Arcanesoft\Auth\Auth;

/**
 * Class     PermissionsRepository
 *
 * @package  Arcanesoft\Auth\Repositories
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PermissionsRepository extends Respository
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
}
