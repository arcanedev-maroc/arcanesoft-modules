<?php

namespace Arcanesoft\Foundation\ViewComposers;

use Arcanesoft\Foundation\Helpers\Sidebar\Manager;
use Illuminate\View\View;

/**
 * Class     SidebarComposer
 *
 * @package  Arcanesoft\Foundation\ViewComposers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SidebarComposer
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const MAIN_SIDEBAR_VIEW = 'foundation::_template.sidebar';

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * @var \Arcanesoft\Foundation\Helpers\Sidebar\Manager
     */
    private $manager;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     */
    public function compose(View $view)
    {
        $items = config()->get('arcanesoft.foundation.sidebar.items', []);

        $sidebar = $this->manager
            ->loadFromConfig($items)
            ->setSelectedItem($view->currentSidebarItem ?? '');

        $view->with('sidebar', $sidebar);
    }

    /**
     * Get the composer views.
     *
     * @return string|array
     */
    public static function views()
    {
        return static::MAIN_SIDEBAR_VIEW;
    }
}
