<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Transformers;

use Arcanesoft\Foundation\Auth\Models\Admin;
use Arcanesoft\Foundation\Auth\Policies\AdminsPolicy;
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
     * Transform the users for datatable.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin  $user
     *
     * @return array
     */
    public function transform(Admin $user): array
    {
        $actions = static::getActions($user);

        return [
            'avatar'     => '<span class="avatar" style="background-image: url('.$user->avatar.')" title="'.$user->full_name.'"></span>',
            'first_name' => $user->first_name,
            'last_name'  => $user->last_name,
            'email'      => $user->email,
            'created_at' => "<small>{$user->created_at->format('Y-m-d H:i:s')}</small>",
            'status'     => '<span class="status '.($user->isActive() ? 'status-success status-animated' : 'status-secondary').'" data-toggle="tooltip" data-placement="top" title="'.($user->isActive() ? __('Activated') : __('Deactivated')).'"></span>',
            'actions'    => static::renderActions($actions),
        ];
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the users' actions.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin  $user
     *
     * @return array
     */
    private static function getActions(Admin $user): array
    {
        $actions = [];

        if (static::can(AdminsPolicy::ability('show'), [$user]))
            $actions[] = LinkAction::action('show', route('admin::auth.admins.show', [$user]), false)
                ->size('sm');

        if (static::can(AdminsPolicy::ability('update'), [$user]))
            $actions[] = LinkAction::action('edit', route('admin::auth.admins.edit', [$user]), false)
                ->size('sm');

        if (static::can(AdminsPolicy::ability('activate'), [$user]))
            $actions[] = ButtonAction::action($user->isActive() ? 'deactivate' : 'activate', false)
                ->attributeIf($user->isDeletable(), 'onclick', "Foundation.\$emit('auth::admins.activate', ".json_encode(['id' => $user->uuid, 'status' => $user->isActive() ? 'activated' : 'deactivated']).")")
                ->size('sm');

        if (static::can(AdminsPolicy::ability('restore'), [$user]) && $user->trashed())
            $actions[] = ButtonAction::action('restore', false)
                ->attribute('onclick', "window.Foundation.\$emit('auth::admins.restore', ".json_encode(['id' => $user->uuid]).")")
                ->size('sm');

        if (static::can(AdminsPolicy::ability('delete'), [$user]))
            $actions[] = ButtonAction::action('delete', false)
                ->attributeIf($user->isDeletable(), 'onclick', "window.Foundation.\$emit('auth::admins.delete', ".json_encode(['id' => $user->uuid]).")")
                ->size('sm');

        return $actions;
    }
}