<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Roles\Users;

use Arcanesoft\Foundation\Auth\Events\Roles\RoleEvent;
use Arcanesoft\Foundation\Auth\Models\Role;

/**
 * Class     DetachedAllUsers
 *
 * @package  Arcanesoft\Foundation\Auth\Events\Roles\Users
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachedAllUsers extends RoleEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  int */
    public $detached;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * DetachedAllUsersFromRole constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role  $role
     * @param  int                                      $detached
     */
    public function __construct(Role $role, $detached)
    {
        parent::__construct($role);

        $this->detached = $detached;
    }
}
