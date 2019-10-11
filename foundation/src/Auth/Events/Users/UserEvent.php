<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Users;

use Arcanesoft\Foundation\Auth\Models\User;

/**
 * Class     UserEvent
 *
 * @package  Arcanesoft\Foundation\Auth\Events\Users
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class UserEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Auth\Models\User */
    public $user;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * UserEvent constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User  $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
