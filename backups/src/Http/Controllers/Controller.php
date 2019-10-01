<?php

namespace Arcanesoft\Backups\Http\Controllers;

use Arcanesoft\Core\Traits\Notifyable;
use Arcanesoft\Foundation\Core\Http\Controller as BaseController;

/**
 * Class     Controller
 *
 * @package  Arcanesoft\Backups\Http\Controllers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class Controller extends BaseController
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The view namespace.
     *
     * @var string
     */
    protected $viewNamespace = 'backups';
}
