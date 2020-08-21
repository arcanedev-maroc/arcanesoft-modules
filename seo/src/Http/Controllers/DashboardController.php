<?php

declare(strict_types=1);

namespace Arcanesoft\Seo\Http\Controllers;

/**
 * Class     DashboardController
 *
 * @package  Arcanesoft\Seo\Http\Controllers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DashboardController extends Controller
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $this->setCurrentSidebarItem('seo::main');
        $this->addBreadcrumb(__('Statistics'));

        return $this->view('dashboard');
    }
}