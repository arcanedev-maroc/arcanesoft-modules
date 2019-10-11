<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Roles;

use Arcanesoft\Foundation\Auth\Models\Role;

/**
 * Class     DetachedAllUsersFromRole
 *
 * @package  Arcanesoft\Foundation\Auth\Events\Roles
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachedAllUsersFromRole extends RoleEvent
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
