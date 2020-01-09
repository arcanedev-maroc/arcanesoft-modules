<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Admins\Roles;

use Arcanesoft\Foundation\Auth\Events\Admins\AdminEvent;
use Arcanesoft\Foundation\Auth\Models\Admin;
use Illuminate\Support\Collection;

/**
 * Class     SyncingRoles
 *
 * @package  Arcanesoft\Foundation\Auth\Events\Admins\Roles
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SyncingRoles extends AdminEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Illuminate\Support\Collection */
    public $roles;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * SyncingRolesToAdmin constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin  $admin
     * @param  \Illuminate\Support\Collection            $roles
     */
    public function __construct(Admin $admin, Collection $roles)
    {
        parent::__construct($admin);

        $this->roles = $roles;
    }
}