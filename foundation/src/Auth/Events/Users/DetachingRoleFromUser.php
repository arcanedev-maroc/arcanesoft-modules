<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Users;

use Arcanesoft\Foundation\Auth\Models\User;

/**
 * Class     DetachingRoleFromUser
 *
 * @package  Arcanesoft\Foundation\Auth\Events\Users
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachingRoleFromUser extends UserEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Auth\Models\Role|int */
    public $role;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * DetachedRoleFromUser constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User      $user
     * @param  \Arcanesoft\Foundation\Auth\Models\Role|int  $role
     */
    public function __construct(User $user, $role)
    {
        parent::__construct($user);

        $this->role = $role;
    }
}
