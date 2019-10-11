<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Roles;

use Arcanesoft\Foundation\Auth\Models\Role;

/**
 * Class     DetachedPermissionFromRole
 *
 * @package  Arcanesoft\Foundation\Auth\Events\Roles
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachedPermissionFromRole extends RoleEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Auth\Models\Permission|int */
    public $permission;

    /** @var  int */
    public $detached;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * DetachedPermissionFromRole constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role            $role
     * @param  \Arcanesoft\Foundation\Auth\Models\Permission|int  $permission
     * @param  int                                                $detached
     */
    public function __construct(Role $role, $permission, $detached)
    {
        parent::__construct($role);

        $this->permission = $permission;
        $this->detached   = $detached;
    }
}
