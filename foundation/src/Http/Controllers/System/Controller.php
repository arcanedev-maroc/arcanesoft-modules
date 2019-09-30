<?php namespace Arcanesoft\Foundation\Http\Controllers\System;

use Arcanesoft\Foundation\Http\Controllers\Controller as BaseController;

/**
 * Class     Controller
 *
 * @package  Arcanesoft\Foundation\Http\Controllers\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class Controller extends BaseController
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct()
    {
        parent::__construct();

        $this->addBreadcrumbRoute(__('System'), 'admin::foundation.system.index');
    }
}
