<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Roles\Users;

use Arcanesoft\Foundation\Auth\Events\Roles\RoleEvent;
use Arcanesoft\Foundation\Auth\Models\Role;

/**
 * Class     DetachedUser
 *
 * @package  Arcanesoft\Foundation\Auth\Events\Roles\Users
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachedUser extends RoleEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Auth\Models\User|int */
    public $user;

    /** @var  int */
    public $detached;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * DetachedUserFromRole constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role      $role
     * @param  \Arcanesoft\Foundation\Auth\Models\User|int  $user
     * @param  int                                          $detached
     */
    public function __construct(Role $role, $user, $detached)
    {
        parent::__construct($role);

        $this->user     = $user;
        $this->detached = $detached;
    }
}
