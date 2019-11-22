<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Admins;

use Arcanesoft\Foundation\Auth\Models\Admin;

/**
 * Class     AdminEvent
 *
 * @package  Arcanesoft\Foundation\Auth\Events\Admins
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class AdminEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Auth\Models\Admin */
    public $admin;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * AdminEvent constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin  $admin
     */
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }
}