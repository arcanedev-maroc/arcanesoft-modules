<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Roles\Administrators;

use Arcanesoft\Foundation\Auth\Events\Roles\RoleEvent;
use Arcanesoft\Foundation\Auth\Models\Role;

/**
 * Class     AttachingAdministrator
 *
 * @package  Arcanesoft\Foundation\Auth\Events\Roles\Administrators
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AttachingAdministrator extends RoleEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Auth\Models\Administrator|int */
    public $administrator;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * AttachingAdministrator constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Role               $role
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator|int  $administrator
     */
    public function __construct(Role $role, $administrator)
    {
        parent::__construct($role);

        $this->administrator = $administrator;
    }
}