<?php

namespace Arcanesoft\Foundation\Http\Controllers\System;

use Arcanedev\LaravelPolicies\Ability;
use Arcanedev\LaravelPolicies\Contracts\PolicyManager;
use Illuminate\Support\Facades\Gate;

/**
 * Class     AbilitiesController
 *
 * @package  Arcanesoft\Foundation\Http\Controllers\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AbilitiesController extends Controller
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanedev\LaravelPolicies\Contracts\PolicyManager */
    private $manager;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct(PolicyManager $manager)
    {
        $this->manager = $manager;

        parent::__construct();

        $this->setCurrentSidebarItem('foundation::system.info');
        $this->addBreadcrumbRoute(__('Abilities'), 'admin::foundation.system.abilities.index');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function index()
    {
//        $this->authorize(MaintenancePolicy::ability('index'));

        $abilities = $this->manager->abilities()->map(function (Ability $ability) {
            return $ability->setMeta('registered', Gate::has($ability->key()));
        });

        return $this->view('system.abilities.index', compact('abilities'));
    }
}