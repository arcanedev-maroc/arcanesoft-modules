<?php namespace Arcanesoft\Auth\Events\Roles;

use Arcanesoft\Auth\Models\Role;

/**
 * Class     DetachedPermissionFromRole
 *
 * @package  Arcanesoft\Auth\Events\Roles
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachedPermissionFromRole extends RoleEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Auth\Models\Permission|int */
    public $permission;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * DetachedPermissionFromRole constructor.
     *
     * @param  \Arcanesoft\Auth\Models\Role            $role
     * @param  \Arcanesoft\Auth\Models\Permission|int  $permission
     * @param  int                                     $results
     */
    public function __construct(Role $role, $permission, $results)
    {
        parent::__construct($role);

        $this->permission = $permission;
    }
}
