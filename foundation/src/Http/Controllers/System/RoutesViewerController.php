<?php namespace Arcanesoft\Foundation\Http\Controllers\System;

use Arcanedev\RouteViewer\Contracts\RouteViewer;

/**
 * Class     RoutesViewerController
 *
 * @package  Arcanesoft\Foundation\Http\Controllers\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RoutesViewerController extends Controller
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct()
    {
        parent::__construct();

        $this->addBreadcrumbRoute(__('Routes Viewer'), 'admin::foundation.system.routes-viewer.index');
        $this->setCurrentSidebarItem('foundation::system.routes-viewer');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index(RouteViewer $routeViewer)
    {
        $routes = $routeViewer->all();

        return $this->view('system.routes-viewer.index', compact('routes'));
    }
}
