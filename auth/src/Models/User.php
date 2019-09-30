<?php namespace Arcanesoft\Auth\Models;

use Arcanedev\LaravelImpersonator\Contracts\Impersonatable;
use Arcanedev\LaravelImpersonator\Traits\CanImpersonate;
use Arcanesoft\Auth\Auth;
use Arcanesoft\Auth\Events\Users\{ActivatedUser, ActivatingUser, AttachedRoleToUser, AttachingRoleToUser, CreatedUser,
    CreatingUser, DeactivatedUser, DeactivatingUser, DeletedUser, DeletingUser, DetachedRoleFromUser,
    DetachedRolesFromUser, DetachingRoleFromUser, DetachingRolesFromUser, ForceDeletedUser, ReplicatingUser,
    RestoredUser, RestoringUser, RetrievedUser, SavedUser, SavingUser, SyncedRolesToUser, SyncingRolesToUser,
    UpdatedUser, UpdatingUser};
use Arcanesoft\Auth\Models\Concerns\Activatable;
use Arcanesoft\Auth\Models\Concerns\HasRoles;
use Arcanesoft\Auth\Models\Presenters\UserPresenter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

/**
 * Class     User
 *
 * @package  Arcanesoft\Auth\Models
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  int                         id
 * @property  string                      uuid
 * @property  string                      first_name
 * @property  string                      last_name
 * @property  string                      email
 * @property  \Illuminate\Support\Carbon  email_verified_at
 * @property  string                      password
 * @property  string                      avatar
 * @property  string                      remember_token
 * @property  boolean                     is_admin
 * @property  \Illuminate\Support\Carbon  last_activity_at
 * @property  \Illuminate\Support\Carbon  created_at
 * @property  \Illuminate\Support\Carbon  updated_at
 * @property  \Illuminate\Support\Carbon  deleted_at
 *
 * @property  \Illuminate\Database\Eloquent\Collection  permissions
 *
 * @method  static|\Illuminate\Database\Eloquent\Builder  verifiedEmail()
 */
class User extends Authenticatable implements Impersonatable
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use UserPresenter,
        HasRoles,
        Notifiable,
        Activatable,
        CanImpersonate,
        SoftDeletes;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_admin'          => 'boolean',
        'email_verified_at' => 'datetime',
        'last_activity_at'  => 'datetime',
        'activated_at'      => 'datetime',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'retrieved'    => RetrievedUser::class,
        'creating'     => CreatingUser::class,
        'created'      => CreatedUser::class,
        'updating'     => UpdatingUser::class,
        'updated'      => UpdatedUser::class,
        'saving'       => SavingUser::class,
        'saved'        => SavedUser::class,
        'deleting'     => DeletingUser::class,
        'deleted'      => DeletedUser::class,
        'forceDeleted' => ForceDeletedUser::class,
        'restoring'    => RestoringUser::class,
        'restored'     => RestoredUser::class,
        'replicating'  => ReplicatingUser::class,
    ];

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->setConnection(config('arcanesoft.auth.database.connection'));
        $this->setTable(Auth::table('users'));

        parent::__construct($attributes);
    }

    /* -----------------------------------------------------------------
     |  Relationships
     | -----------------------------------------------------------------
     */

    /**
     * The roles' relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(
            Auth::model('role', Role::class),
            Auth::table('role-user', 'role_user')
        )
            ->using(Pivots\RoleUser::class)
            ->as('role_user')
            ->withPivot(['created_at']);
    }

    /**
     * Get all user permissions.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getPermissionsAttribute()
    {
        return $this->active_roles
            ->pluck('permissions')
            ->flatten()
            ->unique(function (Permission $permission) {
                return $permission->getKey();
            });
    }

    /* -----------------------------------------------------------------
     |  Scopes
     | -----------------------------------------------------------------
     */

    /**
     * Scope only verified email users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVerifiedEmail(Builder $query)
    {
        return $query->whereNotNull('email_verified_at');
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Activate the user.
     *
     * @param  bool  $save
     *
     * @return bool
     */
    public function activate($save = true)
    {
        event(new ActivatingUser($this));
        $result = $this->switchActive(true, $save);
        event(new ActivatedUser($this));

        return $result;
    }

    /**
     * Deactivate the user.
     *
     * @param  bool  $save
     *
     * @return bool
     */
    public function deactivate($save = true)
    {
        event(new DeactivatingUser($this));
        $result = $this->switchActive(false, $save);
        event(new DeactivatedUser($this));

        return $result;
    }

    /**
     * Attach a role to a user.
     *
     * @param  \Arcanesoft\Auth\Models\Role|int  $role
     * @param  bool                              $reload
     */
    public function attachRole($role, $reload = true)
    {
        if ($this->hasRole($role))
            return;

        event(new AttachingRoleToUser($this, $role));
        $this->roles()->attach($role);
        event(new AttachedRoleToUser($this, $role));

        $this->loadRoles($reload);
    }

    /**
     * Sync the roles by its keys.
     *
     * @param  array|\Illuminate\Support\Collection  $keys
     * @param  bool                                  $reload
     *
     * @return array
     */
    public function syncRoles($keys, bool $reload = true)
    {
        return $this->performSyncRoles(
            $keys, $reload, SyncingRolesToUser::class, SyncedRolesToUser::class
        );
    }

    /**
     * Detach a role from a user.
     *
     * @param  \Arcanesoft\Auth\Models\Role|int  $role
     * @param  bool                              $reload
     *
     * @return int
     */
    public function detachRole($role, $reload = true)
    {
        event(new DetachingRoleFromUser($this, $role));
        $results = $this->roles()->detach($role);
        event(new DetachedRoleFromUser($this, $role, $results));

        $this->loadRoles($reload);

        return $results;
    }

    /**
     * Detach all roles from a user.
     *
     * @param  bool  $reload
     *
     * @return int
     */
    public function detachAllRoles($reload = true)
    {
        event(new DetachingRolesFromUser($this));
        $results = $this->roles()->detach();
        event(new DetachedRolesFromUser($this, $results));

        $this->loadRoles($reload);

        return $results;
    }

    /* -----------------------------------------------------------------
     |  Permission Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if the user has a permission.
     *
     * @param  string  $ability
     *
     * @return bool
     */
    public function may($ability)
    {
        return $this->permissions->filter(function (Permission $permission) use ($ability) {
            return $permission->hasAbility($ability);
        })->isNotEmpty();
    }

    /**
     * Check if the user has at least one permission.
     *
     * @param  \Illuminate\Support\Collection|array  $permissions
     * @param  \Illuminate\Support\Collection        &$failed
     *
     * @return bool
     */
    public function mayOne($permissions, &$failed = null)
    {
        $permissions = $permissions instanceof Collection
            ? $permissions
            : $this->newCollection($permissions);

        $failed = $permissions->reject(function ($permission) {
            return $this->may($permission);
        })->values();

        return $permissions->count() !== $failed->count();
    }

    /**
     * Check if the user has all permissions.
     *
     * @param  \Illuminate\Support\Collection|array  $permissions
     * @param  \Illuminate\Support\Collection        &$failed
     *
     * @return bool
     */
    public function mayAll($permissions, &$failed = null)
    {
        $this->mayOne($permissions, $failed);

        return $failed instanceof Collection
            ? $failed->isEmpty()
            : false;
    }

    /**
     * Update the user's last activity.
     *
     * @return bool
     */
    public function updateLastActivity()
    {
        return $this->forceFill([
            'last_activity_at' => $this->freshTimestamp(),
        ])->save();
    }

    /* -----------------------------------------------------------------
     |  Check Methods
     | -----------------------------------------------------------------
     */

    /**
     * Check if the user is deletable.
     *
     * @return bool
     */
    public function isDeletable()
    {
        return ! $this->isSuperAdmin();
    }

    /**
     * Check if the model is not deletable.
     *
     * @return bool
     */
    public function isNotDeletable()
    {
        return ! $this->isDeletable();
    }

    /**
     * Check if the user is a super admin.
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->is_admin;
    }

    /**
     * Check if the user is an admin.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->isSuperAdmin()
            || $this->hasRoleKey(Role::ADMINISTRATOR);
    }

    /**
     * Check if user is a moderator.
     *
     * @return bool
     */
    public function isModerator()
    {
        return $this->hasRoleKey(Role::MODERATOR);
    }

    /**
     * Check if user is a member.
     *
     * @return bool
     */
    public function isMember()
    {
        return ! $this->isAdmin();
    }

    /**
     * Check if the current modal can impersonate other models.
     *
     * @return  bool
     */
    public function canImpersonate(): bool
    {
        return impersonator()->isEnabled() && $this->isAdmin();
    }
    /**
     * Check if the current model can be impersonated.
     *
     * @return  bool
     */
    public function canBeImpersonated(): bool
    {
        return impersonator()->isEnabled() && ! $this->isAdmin();
    }
}
