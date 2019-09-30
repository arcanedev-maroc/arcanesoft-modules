<?php namespace Arcanesoft\Auth\Events\Roles;

use Arcanesoft\Auth\Models\Role;

/**
 * Class     DetachedUserFromRole
 *
 * @package  Arcanesoft\Auth\Events\Roles
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachedUserFromRole extends RoleEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Auth\Models\User|int */
    public $user;

    /** @var  int */
    public $results;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * DetachedUserFromRole constructor.
     *
     * @param  \Arcanesoft\Auth\Models\Role      $role
     * @param  \Arcanesoft\Auth\Models\User|int  $user
     * @param  int                               $results
     */
    public function __construct(Role $role, $user, $results)
    {
        parent::__construct($role);

        $this->user    = $user;
        $this->results = $results;
    }
}
