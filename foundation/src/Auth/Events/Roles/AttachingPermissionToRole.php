<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Roles;

use Arcanesoft\Foundation\Auth\Models\Role;

/**
 * Class     AttachingPermissionToRole
 *
 * @package  Arcanesoft\Foundation\Auth\Events\Roles
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AttachingPermissionToRole extends RoleEvent
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
     * AttachingPermissionToRole constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role      $role
     * @param  \Arcanesoft\Foundation\Auth\Models\Role|int  $permission
     */
    public function __construct(Role $role, $permission)
    {
        parent::__construct($role);

        $this->permission = $permission;
    }
}
