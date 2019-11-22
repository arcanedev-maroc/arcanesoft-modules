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

    Arcanesoft\Foundation\Auth\Events\Users\CreatingUser::class => [
        Arcanesoft\Foundation\Auth\Listeners\Users\GeneratesUuid::class
    ],
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

    Arcanesoft\Foundation\Auth\Events\Users\AttachingRoleToUser::class => [],
    Arcanesoft\Foundation\Auth\Events\Users\AttachedRoleToUser::class => [],
    Arcanesoft\Foundation\Auth\Events\Users\DetachingRoleFromUser::class => [],
    Arcanesoft\Foundation\Auth\Events\Users\DetachedRoleFromUser::class => [],

    Arcanesoft\Foundation\Auth\Events\Users\DetachingRolesFromUser::class => [],
    Arcanesoft\Foundation\Auth\Events\Users\DetachedRolesFromUser::class => [],
    Arcanesoft\Foundation\Auth\Events\Users\SyncingRolesToUser::class => [],
    Arcanesoft\Foundation\Auth\Events\Users\SyncedRolesToUser::class => [],

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

    Arcanesoft\Foundation\Auth\Events\Admins\AttachingRoleToAdmin::class => [],
    Arcanesoft\Foundation\Auth\Events\Admins\AttachedRoleToAdmin::class => [],
    Arcanesoft\Foundation\Auth\Events\Admins\DetachingRoleFromAdmin::class => [],
    Arcanesoft\Foundation\Auth\Events\Admins\DetachedRoleFromAdmin::class => [],

    Arcanesoft\Foundation\Auth\Events\Admins\DetachingRolesFromAdmin::class => [],
    Arcanesoft\Foundation\Auth\Events\Admins\DetachedRolesFromAdmin::class => [],
    Arcanesoft\Foundation\Auth\Events\Admins\SyncingRolesToAdmin::class => [],
    Arcanesoft\Foundation\Auth\Events\Admins\SyncedRolesToAdmin::class => [],

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

    Arcanesoft\Foundation\Auth\Events\Roles\AttachingUserToRole::class             => [],
    Arcanesoft\Foundation\Auth\Events\Roles\AttachedUserToRole::class              => [],
    Arcanesoft\Foundation\Auth\Events\Roles\DetachingUserFromRole::class           => [],
    Arcanesoft\Foundation\Auth\Events\Roles\DetachedUserFromRole::class            => [],

    Arcanesoft\Foundation\Auth\Events\Roles\DetachingAllUsersFromRole::class       => [],
    Arcanesoft\Foundation\Auth\Events\Roles\DetachedAllUsersFromRole::class        => [],

    Arcanesoft\Foundation\Auth\Events\Roles\AttachingPermissionToRole::class       => [],
    Arcanesoft\Foundation\Auth\Events\Roles\AttachedPermissionToRole::class        => [],
    Arcanesoft\Foundation\Auth\Events\Roles\DetachingPermissionFromRole::class     => [],
    Arcanesoft\Foundation\Auth\Events\Roles\DetachedPermissionFromRole::class      => [],

    Arcanesoft\Foundation\Auth\Events\Roles\SyncingPermissionsToRole::class        => [],
    Arcanesoft\Foundation\Auth\Events\Roles\SyncedPermissionsToRole::class         => [],
    Arcanesoft\Foundation\Auth\Events\Roles\DetachingAllPermissionsFromRole::class => [],
    Arcanesoft\Foundation\Auth\Events\Roles\DetachedAllPermissionsFromRole::class  => [],

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

    Arcanesoft\Foundation\Auth\Events\Permissions\AttachingRoleToPermission::class => [],
    Arcanesoft\Foundation\Auth\Events\Permissions\AttachedRoleToPermission::class => [],
    Arcanesoft\Foundation\Auth\Events\Permissions\DetachingRoleFromPermission::class => [],
    Arcanesoft\Foundation\Auth\Events\Permissions\DetachedRoleFromPermission::class => [],

    Arcanesoft\Foundation\Auth\Events\Permissions\SyncedRolesToPermission::class => [],
    Arcanesoft\Foundation\Auth\Events\Permissions\SyncingRolesToPermission::class => [],
    Arcanesoft\Foundation\Auth\Events\Permissions\DetachingAllRolesFromPermission::class => [],
    Arcanesoft\Foundation\Auth\Events\Permissions\DetachedAllRolesFromPermission::class => [],

];
