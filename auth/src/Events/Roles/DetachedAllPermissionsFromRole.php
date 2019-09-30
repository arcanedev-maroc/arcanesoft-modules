<?php namespace Arcanesoft\Auth\Events\Roles;

use Arcanesoft\Auth\Models\Role;

/**
 * Class     DetachedAllPermissionsFromRole
 *
 * @package  Arcanesoft\Auth\Events\Roles
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachedAllPermissionsFromRole extends RoleEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  int */
    public $results;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * DetachedAllPermissionsFromRole constructor.
     *
     * @param  \Arcanesoft\Auth\Models\Role  $role
     * @param  int                           $results
     */
    public function __construct(Role $role, $results)
    {
        parent::__construct($role);

        $this->results = $results;
    }
}
