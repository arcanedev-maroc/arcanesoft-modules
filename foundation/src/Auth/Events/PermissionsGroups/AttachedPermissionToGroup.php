<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\PermissionsGroups;

use Arcanesoft\Foundation\Auth\Models\{Permission, PermissionsGroup};

/**
 * Class     AttachedPermissionToGroup
 *
 * @package  Arcanesoft\Foundation\Auth\Events\PermissionsGroups
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AttachedPermissionToGroup extends PermissionsGroupEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Auth\Models\Permission|mixed */
    public $permission;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * AttachedPermissionToGroup constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\PermissionsGroup  $group
     * @param  \Arcanesoft\Foundation\Auth\Models\Permission|mixed  $permission
     */
    public function __construct(PermissionsGroup $group, Permission $permission)
    {
        parent::__construct($group);

        $this->permission = $permission;
    }
}
