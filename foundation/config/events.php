<?php

return [

    /* -----------------------------------------------------------------
     |  Foundation - UI
     | -----------------------------------------------------------------
     */

    Arcanesoft\Foundation\Core\Events\UI\SidebarToggled::class => [
        Arcanesoft\Foundation\Core\Listeners\UI\PersistToggledSidebar::class,
    ],

    Arcanesoft\Foundation\Core\Events\UI\SkinModeToggled::class => [
        Arcanesoft\Foundation\Core\Listeners\UI\PersistToggledSkinMode::class,
    ],

    /* -----------------------------------------------------------------
     |  Auth - Users
     | -----------------------------------------------------------------
     */

    Arcanesoft\Foundation\Auth\Events\Users\RetrievedUser::class => [],

    Arcanesoft\Foundation\Auth\Events\Users\CreatingUser::class => [],
    Arcanesoft\Foundation\Auth\Events\Users\CreatedUser::class => [],

    Arcanesoft\Foundation\Auth\Events\Users\UpdatingUser::class => [],
    Arcanesoft\Foundation\Auth\Events\Users\UpdatedUser::class => [],

    Arcanesoft\Foundation\Auth\Events\Users\SavingUser::class => [],
    Arcanesoft\Foundation\Auth\Events\Users\SavedUser::class => [],

    Arcanesoft\Foundation\Auth\Events\Users\DeletingUser::class => [],
    Arcanesoft\Foundation\Auth\Events\Users\DeletedUser::class => [],
    Arcanesoft\Foundation\Auth\Events\Users\ForceDeletedUser::class => [],

    Arcanesoft\Foundation\Auth\Events\Users\RestoringUser::class => [],
    Arcanesoft\Foundation\Auth\Events\Users\RestoredUser::class => [],

    Arcanesoft\Foundation\Auth\Events\Users\ReplicatingUser::class => [],

    Arcanesoft\Foundation\Auth\Events\Users\ActivatingUser::class => [],
    Arcanesoft\Foundation\Auth\Events\Users\ActivatedUser::class => [],
    Arcanesoft\Foundation\Auth\Events\Users\DeactivatingUser::class => [],
    Arcanesoft\Foundation\Auth\Events\Users\DeactivatedUser::class => [],

    /* -----------------------------------------------------------------
     |  Auth - Admins
     | -----------------------------------------------------------------
     */

    Arcanesoft\Foundation\Auth\Events\Admins\RetrievedAdmin::class => [],

    Arcanesoft\Foundation\Auth\Events\Admins\CreatingAdmin::class => [
        Arcanesoft\Foundation\Auth\Listeners\Admins\GeneratesUuid::class
    ],
    Arcanesoft\Foundation\Auth\Events\Admins\CreatedAdmin::class => [],

    Arcanesoft\Foundation\Auth\Events\Admins\UpdatingAdmin::class => [],
    Arcanesoft\Foundation\Auth\Events\Admins\UpdatedAdmin::class => [],

    Arcanesoft\Foundation\Auth\Events\Admins\SavingAdmin::class => [],
    Arcanesoft\Foundation\Auth\Events\Admins\SavedAdmin::class => [],

    Arcanesoft\Foundation\Auth\Events\Admins\DeletingAdmin::class => [],
    Arcanesoft\Foundation\Auth\Events\Admins\DeletedAdmin::class => [],
    Arcanesoft\Foundation\Auth\Events\Admins\ForceDeletedAdmin::class => [],

    Arcanesoft\Foundation\Auth\Events\Admins\RestoringAdmin::class => [],
    Arcanesoft\Foundation\Auth\Events\Admins\RestoredAdmin::class => [],

    Arcanesoft\Foundation\Auth\Events\Admins\ReplicatingAdmin::class => [],

    Arcanesoft\Foundation\Auth\Events\Admins\ActivatingAdmin::class => [],
    Arcanesoft\Foundation\Auth\Events\Admins\ActivatedAdmin::class => [],
    Arcanesoft\Foundation\Auth\Events\Admins\DeactivatingAdmin::class => [],
    Arcanesoft\Foundation\Auth\Events\Admins\DeactivatedAdmin::class => [],

    Arcanesoft\Foundation\Auth\Events\Admins\Roles\AttachingRole::class => [],
    Arcanesoft\Foundation\Auth\Events\Admins\Roles\AttachedRole::class => [],
    Arcanesoft\Foundation\Auth\Events\Admins\Roles\DetachingRole::class => [],
    Arcanesoft\Foundation\Auth\Events\Admins\Roles\DetachedRole::class => [],

    Arcanesoft\Foundation\Auth\Events\Admins\Roles\DetachingRoles::class => [],
    Arcanesoft\Foundation\Auth\Events\Admins\Roles\DetachedRoles::class => [],
    Arcanesoft\Foundation\Auth\Events\Admins\Roles\SyncingRoles::class => [],
    Arcanesoft\Foundation\Auth\Events\Admins\Roles\SyncedRoles::class => [],

    /* -----------------------------------------------------------------
     |  Auth - Roles
     | -----------------------------------------------------------------
     */

    Arcanesoft\Foundation\Auth\Events\Roles\RetrievedRole::class                   => [],

    Arcanesoft\Foundation\Auth\Events\Roles\CreatingRole::class                    => [
        Arcanesoft\Foundation\Auth\Listeners\Roles\GeneratesUuid::class,
    ],
    Arcanesoft\Foundation\Auth\Events\Roles\CreatedRole::class                     => [],

    Arcanesoft\Foundation\Auth\Events\Roles\UpdatingRole::class                    => [],
    Arcanesoft\Foundation\Auth\Events\Roles\UpdatedRole::class                     => [],

    Arcanesoft\Foundation\Auth\Events\Roles\SavingRole::class                      => [],
    Arcanesoft\Foundation\Auth\Events\Roles\SavedRole::class                       => [],

    Arcanesoft\Foundation\Auth\Events\Roles\DeletingRole::class                    => [
        Arcanesoft\Foundation\Auth\Listeners\Roles\DetachPermissions::class,
        Arcanesoft\Foundation\Auth\Listeners\Roles\DetachAdmins::class,
    ],
    Arcanesoft\Foundation\Auth\Events\Roles\DeletedRole::class                     => [],

    Arcanesoft\Foundation\Auth\Events\Roles\Users\AttachingUser::class             => [],
    Arcanesoft\Foundation\Auth\Events\Roles\Users\AttachedUser::class              => [],
    Arcanesoft\Foundation\Auth\Events\Roles\Users\DetachingUser::class           => [],
    Arcanesoft\Foundation\Auth\Events\Roles\Users\DetachedUser::class            => [],

    Arcanesoft\Foundation\Auth\Events\Roles\Users\DetachingAllUsers::class       => [],
    Arcanesoft\Foundation\Auth\Events\Roles\Users\DetachedAllUsers::class        => [],

    Arcanesoft\Foundation\Auth\Events\Roles\Permissions\AttachingPermission::class       => [],
    Arcanesoft\Foundation\Auth\Events\Roles\Permissions\AttachedPermission::class        => [],
    Arcanesoft\Foundation\Auth\Events\Roles\Permissions\DetachingPermission::class     => [],
    Arcanesoft\Foundation\Auth\Events\Roles\Permissions\DetachedPermission::class      => [],

    Arcanesoft\Foundation\Auth\Events\Roles\Permissions\SyncingPermissions::class        => [],
    Arcanesoft\Foundation\Auth\Events\Roles\Permissions\SyncedPermissions::class         => [],
    Arcanesoft\Foundation\Auth\Events\Roles\Permissions\DetachingAllPermissions::class => [],
    Arcanesoft\Foundation\Auth\Events\Roles\Permissions\DetachedAllPermissions::class  => [],

    /* -----------------------------------------------------------------
     |  Auth - Permissions
     | -----------------------------------------------------------------
     */

    Arcanesoft\Foundation\Auth\Events\Permissions\RetrievedPermission::class => [],

    Arcanesoft\Foundation\Auth\Events\Permissions\CreatingPermission::class => [
        Arcanesoft\Foundation\Auth\Listeners\Permissions\GeneratesUuid::class,
    ],
    Arcanesoft\Foundation\Auth\Events\Permissions\CreatedPermission::class => [],

    Arcanesoft\Foundation\Auth\Events\Permissions\UpdatingPermission::class => [],
    Arcanesoft\Foundation\Auth\Events\Permissions\UpdatedPermission::class => [],

    Arcanesoft\Foundation\Auth\Events\Permissions\SavingPermission::class => [],
    Arcanesoft\Foundation\Auth\Events\Permissions\SavedPermission::class => [],

    Arcanesoft\Foundation\Auth\Events\Permissions\DeletingPermission::class => [],
    Arcanesoft\Foundation\Auth\Events\Permissions\DeletedPermission::class => [],

    Arcanesoft\Foundation\Auth\Events\Permissions\Roles\AttachingRole::class => [],
    Arcanesoft\Foundation\Auth\Events\Permissions\Roles\AttachedRole::class => [],
    Arcanesoft\Foundation\Auth\Events\Permissions\Roles\DetachingRole::class => [],
    Arcanesoft\Foundation\Auth\Events\Permissions\Roles\DetachedRole::class => [],

    Arcanesoft\Foundation\Auth\Events\Permissions\Roles\SyncedRoles::class => [],
    Arcanesoft\Foundation\Auth\Events\Permissions\Roles\SyncingRoles::class => [],
    Arcanesoft\Foundation\Auth\Events\Permissions\Roles\DetachingAllRoles::class => [],
    Arcanesoft\Foundation\Auth\Events\Permissions\Roles\DetachedAllRoles::class => [],

];
