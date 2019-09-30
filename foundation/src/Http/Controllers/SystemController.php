<?php namespace Arcanesoft\Foundation\Http\Controllers;

use Arcanesoft\Foundation\Policies\System\InformationPolicy;

/**
 * Class     SystemController
 *
 * @package  Arcanesoft\Foundation\Http\Controllers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SystemController extends Controller
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * SystemController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setCurrentSidebarItem('foundation::system.info');
        $this->addBreadcrumbRoute(__('System'), 'admin::foundation.system.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index()
    {
        $this->authorize(InformationPolicy::ability('index'));

        return $this->view('system.index');
    }
}
