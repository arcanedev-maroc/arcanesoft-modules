<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Users;

use Arcanesoft\Foundation\Auth\Models\User;

/**
 * Class     DetachedRoleFromUser
 *
 * @package  Arcanesoft\Foundation\Auth\Events\Users
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachedRoleFromUser extends UserEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Auth\Models\Role|int */
    public $role;

    /** @var  int */
    public $results;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * DetachedRoleFromUser constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User      $user
     * @param  \Arcanesoft\Foundation\Auth\Models\Role|int  $role
     * @param  int                                          $results
     */
    public function __construct(User $user, $role, $results)
    {
        parent::__construct($user);

        $this->role    = $role;
        $this->results = $results;
    }
}
