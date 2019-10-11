<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Controllers;

/**
 * Class     DashboardController
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Controllers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DashboardController extends Controller
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index()
    {
        $this->setCurrentSidebarItem('auth::authorization.dashboard');
        $this->addBreadcrumbParent();

        $this->selectMetrics(config('arcanesoft.auth.metrics.dashboard.index', []));

        return $this->view('auth.dashboard');
    }
}
