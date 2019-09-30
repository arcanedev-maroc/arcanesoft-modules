<?php namespace Arcanesoft\Foundation\Helpers\Sidebar;

class Manager
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Helpers\Sidebar\Collection */
    protected $items;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct()
    {
        $this->items = new Collection;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the sidebar items.
     *
     * @return \Arcanesoft\Foundation\Helpers\Sidebar\Collection
     */
    public function items()
    {
        return $this->items;
    }

    /**
     * Set the selected item.
     *
     * @param  string  $name
     *
     * @return $this
     */
    public function setSelectedItem($name)
    {
        $this->items->setSelected($name);

        return $this;
    }

    /**
     * Load the sidebar items from config files.
     *
     * @param  array  $items
     *
     * @return \Arcanesoft\Foundation\Helpers\Sidebar\Manager
     */
    public function loadFromConfig(array $items): Manager
    {
        foreach ($items as $item) {
            if (is_array($item)) {
                $this->items->pushSidebarItem($item);
            }
            elseif (config()->has($item)) {
                foreach (config()->get($item) as $config)
                    $this->items->pushSidebarItem($config);
            }
        }

        return $this;
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if the sidebar is visible.
     *
     * @return bool
     */
    public static function isVisible()
    {
        return session()->get('foundation.sidebar.visible', 'true') === 'true';
    }
}
