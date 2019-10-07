<?php namespace Arcanesoft\Foundation\Http\Controllers\System;

use Arcanesoft\Foundation\Helpers\MaintenanceMode;
use Arcanesoft\Foundation\Http\Requests\System\StartMaintenanceModeRequest;
use Arcanesoft\Foundation\Policies\System\MaintenancePolicy;

/**
 * Class     MaintenanceController
 *
 * @package  Arcanesoft\Foundation\Http\Controllers\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MaintenanceController extends Controller
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Helpers\MaintenanceMode */
    private $maintenance;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct(MaintenanceMode $maintenance)
    {
        $this->maintenance = $maintenance;

        parent::__construct();

        $this->setCurrentSidebarItem('foundation::system.info');
        $this->addBreadcrumbRoute(__('Maintenance'), 'admin::foundation.system.maintenance.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index()
    {
        $this->authorize(MaintenancePolicy::ability('index'));

        return $this->view('system.maintenance.index', [
            'maintenance' => $this->maintenance,
        ]);
    }

    public function start(StartMaintenanceModeRequest $request)
    {
        $this->authorize(MaintenancePolicy::ability('toggle'));

        $this->maintenance->down(
            $request->get('ips'),
            $request->get('message'),
            $request->get('retry')
        );

        // TODO: Add notification

        return redirect()->back();
    }

    public function stop()
    {
        if ($this->maintenance->isEnabled()) {
            $this->maintenance->up();

            // TODO: Add notification
        }

        return redirect()->back();
    }
}
