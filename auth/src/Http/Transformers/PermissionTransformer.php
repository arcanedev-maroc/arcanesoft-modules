<?php

namespace Arcanesoft\Auth\Http\Transformers;

use Arcanesoft\Auth\Models\Permission;
use Arcanesoft\Foundation\Helpers\UI\Actions\LinkAction;

/**
 * Class     PermissionTransformer
 *
 * @package  Arcanesoft\Auth\Http\Transformers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PermissionTransformer extends AbstractTransformer
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function transform(Permission $permission)
    {
        $rolesCount = $permission->roles->count();

        return [
            'group_id'    => $permission->group->name,
            'category'    => $permission->category,
            'name'        => $permission->name,
            'description' => '<small>'.$permission->description.'</small>',
            'roles_count' => '<span class="badge badge-pill '.($rolesCount > 0 ? 'badge-info' : 'badge-light').'">'.$rolesCount.'</span>',
            'actions'     => static::renderActions([
                LinkAction::action('show', route('admin::auth.permissions.show', [$permission]), false)->size('sm'),
            ]),
        ];
    }
}
