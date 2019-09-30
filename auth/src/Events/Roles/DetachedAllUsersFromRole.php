<?php namespace Arcanesoft\Auth\Events\Roles;

use Arcanesoft\Auth\Models\Role;

/**
 * Class     DetachedAllUsersFromRole
 *
 * @package  Arcanesoft\Auth\Events\Roles
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachedAllUsersFromRole extends RoleEvent
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
     * DetachedAllUsersFromRole constructor.
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
