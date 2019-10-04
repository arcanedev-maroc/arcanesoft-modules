<?php

namespace Arcanesoft\Foundation\Http\Controllers;

use Arcanesoft\Foundation\Policies\DashboardPolicy;

/**
 * Class     DashboardController
 *
 * @package  Arcanesoft\Foundation\Http\Controllers
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
        $this->authorize(DashboardPolicy::ability('index'));

        $this->setCurrentSidebarItem('foundation::dashboard');

        return $this->view('index');
    }
}
