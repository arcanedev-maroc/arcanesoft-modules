<?php namespace Arcanesoft\Foundation\Helpers\Sidebar;

use Illuminate\Support\Arr;
use Illuminate\Support\HtmlString;

/**
 * Class     SidebarItem
 *
 * @package  Arcanesoft\Foundation\Helpers\Sidebar
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Item
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  string */
    protected $name;

    /** @var  string */
    public $title;

    /** @var  string */
    public $url;

    /** @var  string */
    public $icon;

    /** @var  \Arcanesoft\Foundation\Helpers\Sidebar\Collection */
    public $children;

    /** @var  array */
    protected $roles;

    /** @var  array */
    protected $permissions;

    /** @var boolean */
    private $selected;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * SidebarItem constructor.
     *
     * @param  array  $attributes
     */
    public function __construct(array $attributes)
    {
        $this->name        = Arr::pull($attributes, 'name');
        $this->setTitle(Arr::pull($attributes, 'title'));
        $this->icon        = Arr::pull($attributes, 'icon');
        $this->roles       = Arr::pull($attributes, 'roles', []);
        $this->permissions = Arr::pull($attributes, 'permissions', []);
        $this->children    = (new Collection)->pushSidebarItems(
            Arr::pull($attributes, 'children', [])
        );
        $this->selected    = false;

        $this->parseUrl($attributes);
    }

    /* -----------------------------------------------------------------
     |  Setters & Getters
     | -----------------------------------------------------------------
     */

    /**
     * Set the title.
     *
     * @param  string  $title
     *
     * @return \Arcanesoft\Foundation\Helpers\Sidebar\Item
     */
    public function setTitle($title)
    {
        $this->title = trans()->has($title)
            ? trans()->get($title)
            : __($title);

        return $this;
    }

    /**
     * Set the url.
     *
     * @param  string  $url
     *
     * @return \Arcanesoft\Foundation\Helpers\Sidebar\Item
     */
    public function setUrl($url) : self
    {
        $this->url = $url;

        return $this;
    }

    public function setSelected(string $name) : self
    {
        $this->selected = ($this->name === $name);
        $this->children->setSelected($name);

        return $this;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Set the url from the route.
     *
     * @param  string  $name
     * @param  array   $params
     *
     * @return \Arcanesoft\Foundation\Helpers\Sidebar\Item
     */
    public function route($name, array $params = []) : self
    {
        return $this->setUrl(
            route($name, $params)
        );
    }

    /**
     * Set the url from the action.
     *
     * @param  string|array  $name
     * @param  array         $params
     *
     * @return \Arcanesoft\Foundation\Helpers\Sidebar\Item
     */
    public function action($name, array $params = []) : self
    {
        return $this->setUrl(
            action($name, $params)
        );
    }

    public function icon($classes = '') : HtmlString
    {
        $html = $this->icon
            ? '<i class="' . $this->icon . ' ' . $classes . '"></i>'
            : '';

        return new HtmlString($html);
    }

    /**
     * Get the active/inactive class.
     *
     * @param  string  $active
     * @param  string  $inactive
     *
     * @return string
     */
    public function active($active = 'active', $inactive = '')
    {
        return $this->isActive() ? $active : $inactive;
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if has children.
     *
     * @return bool
     */
    public function hasChildren() : bool
    {
        return $this->children->isNotEmpty();
    }

    public function isActive() : bool
    {
        return $this->isSelected() || $this->children->hasAnySelected();
    }

    public function isSelected() : bool
    {
        return $this->selected;
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Parse the url attribute.
     *
     * @param  array  $attributes
     *
     * @return void
     */
    protected function parseUrl(array $attributes) : void
    {
        if (isset($attributes['url']))
            $this->setUrl($attributes['url']);
        elseif (isset($attributes['route']))
            $this->route(...Arr::wrap($attributes['route']));
        elseif (isset($attributes['action']))
            $this->action(...Arr::wrap($attributes['action']));
        else
            $this->setUrl('#');
    }

    /**
     * Check if can see the item.
     *
     * @param  \App\Models\User|mixed|null  $user
     *
     * @return bool
     */
    public function canSee($user = null): bool
    {
        /** @var  \Arcanesoft\Foundation\Auth\Models\Admin  $user */
        $user = $user ?? auth()->user();

        if ($user->isSuperAdmin())
            return true;

        if ($user->isOne($this->roles))
            return true;

        foreach ($this->permissions as $permission)
            if ($user->can($permission))
                return true;

        return $this->children->filter(function (Item $item) use ($user) {
            return $item->canSee($user);
        })->isNotEmpty();
    }
}
