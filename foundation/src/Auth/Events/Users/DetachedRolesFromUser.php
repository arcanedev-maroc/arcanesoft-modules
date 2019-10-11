<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Users;

use Arcanesoft\Foundation\Auth\Models\User;

/**
 * Class     DetachedRolesFromUser
 *
 * @package  Arcanesoft\Foundation\Auth\Events\Users
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DetachedRolesFromUser extends UserEvent
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
     * DetachedRolesFromUser constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User  $user
     * @param  int                                      $results
     */
    public function __construct(User $user, $results)
    {
        parent::__construct($user);

        $this->results = $results;
    }
}
