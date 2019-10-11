<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\PermissionsGroups;

use Arcanesoft\Foundation\Auth\Models\Permission;
use Arcanesoft\Foundation\Auth\Models\PermissionsGroup;

/**
 * Class     DetachingPermissionFromGroup
 *
 * @package  Arcanesoft\Foundation\Auth\Events\PermissionsGroups
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachingPermissionFromGroup extends PermissionsGroupEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Auth\Models\Permission */
    public $permission;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * DetachingPermissionFromGroup constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\PermissionsGroup  $group
     * @param  \Arcanesoft\Foundation\Auth\Models\Permission        $permission
     */
    public function __construct(PermissionsGroup $group, Permission $permission)
    {
        parent::__construct($group);

        $this->permission = $permission;
    }
}
