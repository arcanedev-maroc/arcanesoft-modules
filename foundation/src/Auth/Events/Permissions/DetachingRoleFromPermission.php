<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Permissions;

use Arcanesoft\Foundation\Auth\Models\Permission;

/**
 * Class     DetachingRoleFromPermission
 *
 * @package  Arcanesoft\Foundation\Auth\Events\Permissions
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachingRoleFromPermission extends PermissionEvent
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
     * DetachingRoleFromPermission constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Permission  $permission
     * @param  \Arcanesoft\Foundation\Auth\Models\Role|int    $role
     */
    public function __construct(Permission $permission, $role)
    {
        parent::__construct($permission);

        $this->role = $role;
    }
}
