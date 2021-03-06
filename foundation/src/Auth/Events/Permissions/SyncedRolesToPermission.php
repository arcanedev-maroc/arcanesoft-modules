<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Permissions;

use Arcanesoft\Foundation\Auth\Models\Permission;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class     SyncedRolesToPermission
 *
 * @package  Arcanesoft\Foundation\Auth\Events\Permissions
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SyncedRolesToPermission extends PermissionEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Illuminate\Database\Eloquent\Collection */
    public $roles;

    /** @var  array */
    public $synced;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * SyncingRolesToPermission constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Permission  $permission
     * @param  \Illuminate\Database\Eloquent\Collection       $roles
     * @param  array                                          $synced
     */
    public function __construct(Permission $permission, Collection $roles, array $synced)
    {
        parent::__construct($permission);

        $this->roles  = $roles;
        $this->synced = $synced;
    }
}
