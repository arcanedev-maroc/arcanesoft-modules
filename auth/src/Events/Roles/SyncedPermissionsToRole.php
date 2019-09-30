<?php namespace Arcanesoft\Auth\Events\Roles;

use Arcanesoft\Auth\Models\Role;

/**
 * Class     SyncedPermissionsToRole
 *
 * @package  Arcanesoft\Auth\Events\Roles
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SyncedPermissionsToRole extends RoleEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Permissions' ids.
     *
     * @var array
     */
    public $ids;

    /**
     * The sync result.
     *
     * @var array
     */
    public $result;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * RoleEvent constructor.
     *
     * @param  \Arcanesoft\Auth\Models\Role  $role
     * @param  array                         $ids
     * @param  array                         $result
     */
    public function __construct(Role $role, array $ids, array $result)
    {
        parent::__construct($role);

        $this->ids = $ids;
        $this->result = $result;
    }
}
