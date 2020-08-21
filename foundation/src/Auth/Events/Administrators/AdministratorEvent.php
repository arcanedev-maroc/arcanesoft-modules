<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Events\Administrators;

use Arcanesoft\Foundation\Auth\Models\Administrator;

/**
 * Class     AdministratorEvent
 *
 * @package  Arcanesoft\Foundation\Auth\Events\Administrators
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class AdministratorEvent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Auth\Models\Administrator */
    public $administrator;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * AdminEvent constructor.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Administrator  $administrator
     */
    public function __construct(Administrator $administrator)
    {
        $this->administrator = $administrator;
    }
}
