<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\PermissionsGroups;

use Arcanesoft\Foundation\Auth\Models\PermissionsGroup;

/**
 * Class     AttachingPermissionsToGroup
 *
 * @package  Arcanesoft\Foundation\Auth\Events\PermissionsGroups
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AttachingPermissionsToGroup extends PermissionsGroupEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  iterable */
    public $permissions;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * AttachingPermissionsToGroup constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\PermissionsGroup  $group
     * @param  iterable                                             $permissions
     */
    public function __construct(PermissionsGroup $group, iterable $permissions)
    {
        parent::__construct($group);

        $this->permissions = $permissions;
    }
}
