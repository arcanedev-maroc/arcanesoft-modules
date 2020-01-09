<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Admins\Roles;

use Arcanesoft\Foundation\Auth\Events\Admins\AdminEvent;
use Arcanesoft\Foundation\Auth\Models\Admin;
use Illuminate\Support\Collection;

/**
 * Class     SyncedRoles
 *
 * @package  Arcanesoft\Foundation\Auth\Events\Admins\Roles
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SyncedRoles extends AdminEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Illuminate\Support\Collection */
    public $roles;

    /** @var  array */
    public $synced;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * SyncingRolesToAdmin constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin  $admin
     * @param  \Illuminate\Support\Collection            $roles
     * @param  array                                     $synced
     */
    public function __construct(Admin $admin, Collection $roles, array $synced)
    {
        parent::__construct($admin);

        $this->roles  = $roles;
        $this->synced = $synced;
    }
}