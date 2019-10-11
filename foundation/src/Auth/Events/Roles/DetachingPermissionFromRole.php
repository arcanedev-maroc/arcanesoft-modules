<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Roles;

use Arcanesoft\Foundation\Auth\Models\Role;

/**
 * Class     DetachingPermissionFromRole
 *
 * @package  Arcanesoft\Foundation\Auth\Events\Roles
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachingPermissionFromRole extends RoleEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Auth\Models\Permission|int */
    public $permission;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * DetachingPermissionFromRole constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role            $role
     * @param  \Arcanesoft\Foundation\Auth\Models\Permission|int  $permission
     */
    public function __construct(Role $role, $permission)
    {
        parent::__construct($role);

        $this->permission = $permission;
    }
}
