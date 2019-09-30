<?php namespace Arcanesoft\Foundation\Http\Controllers;

use Arcanesoft\Core\Http\Controller as BaseController;

/**
 * Class     Controller
 *
 * @package  Arcanesoft\Foundation\Http\Controllers
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
    protected $viewNamespace = 'foundation';
}
