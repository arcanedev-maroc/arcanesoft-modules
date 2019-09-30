<?php namespace Arcanesoft\Auth\Http\Transformers;

use Arcanesoft\Auth\Models\Role;
use Arcanesoft\Auth\Policies\RolesPolicy;
use function ui\action_button_icon;
use function ui\action_link_icon;

/**
 * Class     RoleTransformer
 *
 * @package  Arcanesoft\Auth\Transformers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RoleTransformer extends AbstractTransformer
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Transform the roles for the datatable.
     *
     * @param  \Arcanesoft\Auth\Models\Role  $role
     *
     * @return array
     */
    public function transform(Role $role): array
    {
        $usersCount = $role->users->count();
        $actions    = static::getActions($role);

        return [
            'name'        => $role->name,
            'description' => $role->description,
            'users_count' => '<span class="badge badge-pill '.($usersCount > 0 ? 'badge-info' : 'badge-light').'">'.$usersCount.'</span>',
            'locked'      => '<span class="status '.($role->isLocked() ? 'status-danger' : 'status-secondary').'" data-toggle="tooltip" data-placement="top" title="'.($role->isLocked() ? __('Locked') : __('Unlocked')).'"></span>',
            'status'      => '<span class="status '.($role->isActive() ? 'status-success status-animated' : 'status-secondary').'" data-toggle="tooltip" data-placement="top" title="'.($role->isActive() ? __('Activated') : __('Deactivated')).'"></span>',
            'actions'     => static::renderActions($actions),
        ];
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the users' actions.
     *
     * @param  \Arcanesoft\Auth\Models\Role  $role
     *
     * @return array
     */
    private static function getActions(Role $role): array
    {
        $actions = [];

        if (static::can(RolesPolicy::ability('show'), [$role]))
            $actions[] = action_link_icon('show', route('admin::auth.roles.show', [$role]))
                ->size('sm');

        if (static::can(RolesPolicy::ability('update'), [$role]))
            $actions[] = action_link_icon('edit', $role->isLocked() ? '#' : route('admin::auth.roles.edit', [$role]))
                ->size('sm')
                ->setDisabled($role->isLocked());

        if (static::can(RolesPolicy::ability('activate'), [$role]))
            $actions[] = action_button_icon($role->isActive() ? 'deactivate' : 'activate')
                ->size('sm')
                ->attribute('onclick', "window.Foundation.\$emit('auth::roles.activate', ".json_encode(['id' => $role->getRouteKey(), 'status' => $role->isActive() ? 'activated' : 'deactivated']).")")
                ->setDisabled($role->isLocked());

        if (static::can(RolesPolicy::ability('delete'), [$role]))
            $actions[] = action_button_icon('delete')
                ->size('sm')
                ->attributeIf($role->isDeletable(), 'onclick', "window.Foundation.\$emit('auth::roles.delete', ".json_encode(['id' => $role->getRouteKey()]).")")
                ->setDisabled($role->isNotDeletable());

        return $actions;
    }
}
