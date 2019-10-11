<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Users;

use Arcanesoft\Foundation\Auth\Models\{Role, User};

/**
 * Class     AttachingRoleToUser
 *
 * @package  Arcanesoft\Foundation\Auth\Events\Users
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AttachingRoleToUser extends UserEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Auth\Models\Role */
    public $role;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * AttachingRoleToUser constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User  $user
     * @param  \Arcanesoft\Foundation\Auth\Models\Role  $role
     */
    public function __construct(User $user, Role $role)
    {
        parent::__construct($user);

        $this->role = $role;
    }
}
