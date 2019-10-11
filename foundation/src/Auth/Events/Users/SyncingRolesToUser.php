<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Users;

use Arcanesoft\Foundation\Auth\Models\User;
use Illuminate\Support\Collection;

/**
 * Class     SyncingRolesToUser
 *
 * @package  Arcanesoft\Foundation\Auth\Events\Users
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SyncingRolesToUser extends UserEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Illuminate\Database\Eloquent\Collection */
    public $roles;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * SyncingRolesToUser constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User  $user
     * @param  \Illuminate\Support\Collection           $roles
     */
    public function __construct(User $user, Collection $roles)
    {
        parent::__construct($user);

        $this->roles = $roles;
    }
}
