<?php

declare(strict_types=1);

namespace Arcanesoft\Auth\Events\PermissionsGroups;

use Arcanesoft\Auth\Models\Permission;
use Arcanesoft\Auth\Models\PermissionsGroup;

/**
 * Class     AttachingPermissionToGroup
 *
 * @package  Arcanesoft\Auth\Events\PermissionsGroups
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AttachingPermissionToGroup extends PermissionsGroupEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Auth\Models\Permission */
    public $permission;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * AttachingPermissionToGroup constructor.
     *
     * @param  \Arcanesoft\Auth\Models\PermissionsGroup  $group
     * @param  \Arcanesoft\Auth\Models\Permission        $permission
     */
    public function __construct(PermissionsGroup $group, Permission $permission)
    {
        parent::__construct($group);

        $this->permission = $permission;
    }
}
