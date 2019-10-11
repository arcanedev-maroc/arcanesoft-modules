<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Roles;

use Arcanesoft\Foundation\Auth\Models\Role;

/**
 * Class     AttachedUserToRole
 *
 * @package  Arcanesoft\Foundation\Auth\Events\Roles
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AttachedUserToRole extends RoleEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Auth\Models\User|int */
    public $user;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * AttachedUserToRole constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role      $role
     * @param  \Arcanesoft\Foundation\Auth\Models\User|int  $user
     */
    public function __construct(Role $role, $user)
    {
        parent::__construct($role);

        $this->user = $user;
    }
}
