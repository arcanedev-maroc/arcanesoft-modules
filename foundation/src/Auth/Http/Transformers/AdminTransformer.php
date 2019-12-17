<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Transformers;

use Arcanesoft\Foundation\Auth\Models\Admin;
use Arcanesoft\Foundation\Auth\Policies\AdministratorsPolicy;
use Arcanesoft\Foundation\Helpers\UI\Actions\ButtonAction;
use Arcanesoft\Foundation\Helpers\UI\Actions\LinkAction;

/**
 * Class     AdminTransformer
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Transformers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class AdminTransformer extends AbstractTransformer
{
    /* -----------------------------------------------------------------
    |  Main Methods
    | -----------------------------------------------------------------
    */

    /**
     * Transform the admins for datatable.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin  $admin
     *
     * @return array
     */
    public function transform(Admin $admin): array
    {
        $actions = static::getActions($admin);

        return [
            'avatar'     => '<span class="avatar" style="background-image: url('.$admin->avatar.')" title="'.$admin->full_name.'"></span>',
            'first_name' => $admin->first_name,
            'last_name'  => $admin->last_name,
            'email'      => $admin->email,
            'created_at' => "<small>{$admin->created_at->format('Y-m-d H:i:s')}</small>",
            'status'     => '<span class="status '.($admin->isActive() ? 'status-success status-animated' : 'status-secondary').'" data-toggle="tooltip" data-placement="top" title="'.($admin->isActive() ? __('Activated') : __('Deactivated')).'"></span>',
            'actions'    => static::renderActions($actions),
        ];
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the admins' actions.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin  $admin
     *
     * @return array
     */
    private static function getActions(Admin $admin): array
    {
        $actions = [];

        if (static::can(AdministratorsPolicy::ability('show'), [$admin]))
            $actions[] = LinkAction::action('show', route('admin::auth.administrators.show', [$admin]), false)
                ->size('sm');

        if (static::can(AdministratorsPolicy::ability('update'), [$admin]))
            $actions[] = LinkAction::action('edit', route('admin::auth.administrators.edit', [$admin]), false)
                ->size('sm');

        if (static::can(AdministratorsPolicy::ability('activate'), [$admin]))
            $actions[] = ButtonAction::action($admin->isActive() ? 'deactivate' : 'activate', false)
                ->attributeIf($admin->isDeletable(), 'onclick', "Foundation.\$emit('auth::administrators.activate', ".json_encode(['id' => $admin->uuid, 'status' => $admin->isActive() ? 'activated' : 'deactivated']).")")
                ->size('sm');

        if (static::can(AdministratorsPolicy::ability('restore'), [$admin]) && $admin->trashed())
            $actions[] = ButtonAction::action('restore', false)
                ->attribute('onclick', "window.Foundation.\$emit('auth::administrators.restore', ".json_encode(['id' => $admin->uuid]).")")
                ->size('sm');

        if (static::can(AdministratorsPolicy::ability('delete'), [$admin]))
            $actions[] = ButtonAction::action('delete', false)
                ->attributeIf($admin->isDeletable(), 'onclick', "window.Foundation.\$emit('auth::administrators.delete', ".json_encode(['id' => $admin->uuid]).")")
                ->size('sm');

        return $actions;
    }
}