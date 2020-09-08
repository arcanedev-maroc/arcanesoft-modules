<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Models;

use Arcanedev\LaravelImpersonator\Contracts\Impersonatable;
use Arcanedev\LaravelImpersonator\Traits\CanImpersonate;
use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Auth\Contracts\CanBeActivated;
use Arcanesoft\Foundation\Auth\Events\Users\{
    CreatedUser, CreatingUser, DeletedUser, DeletingUser, ForceDeletedUser, ReplicatingUser, RestoredUser,
    RestoringUser, RetrievedUser, SavedUser, SavingUser, UpdatedUser, UpdatingUser
};
use Arcanesoft\Foundation\Auth\Models\Concerns\{
    Activatable, CanResetPassword, CanVerifyEmail, HasLinkedAccounts, HasPassword, HasSessions,
    HasTwoFactorAuthentication
};
use Arcanesoft\Foundation\Auth\Models\Presenters\UserPresenter;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\{Builder, SoftDeletes};
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class     User
 *
 * @package  Arcanesoft\Foundation\Auth\Models
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  int                              id
 * @property  string                           uuid
 * @property  string                           username
 * @property  string                           first_name
 * @property  string                           last_name
 * @property  string                           email
 * @property  \Illuminate\Support\Carbon|null  email_verified_at
 * @property  string|null                      password
 * @property  string|null                      two_factor_secret
 * @property  string|null                      two_factor_recovery_codes
 * @property  string|null                      remember_token
 * @property  string|null                      avatar
 * @property  \Illuminate\Support\Carbon|null  last_activity_at
 * @property  \Illuminate\Support\Carbon       created_at
 * @property  \Illuminate\Support\Carbon       updated_at
 * @property  \Illuminate\Support\Carbon|null  activated_at
 * @property  \Illuminate\Support\Carbon|null  deleted_at
 *
 * @method  static|\Illuminate\Database\Eloquent\Builder  filterByAuthenticatedUser(User $user)
 * @method  static|\Illuminate\Database\Eloquent\Builder  verifiedEmail()
 */
class User extends Authenticatable implements Impersonatable, MustVerifyEmail, CanBeActivated
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use UserPresenter,
        HasPassword,
        HasSessions,
        Notifiable,
        Activatable,
        CanImpersonate,
        CanResetPassword,
        CanVerifyEmail,
        HasTwoFactorAuthentication,
        HasLinkedAccounts,
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
        'username',
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
        'two_factor'        => Casts\TwoFactorCast::class,
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

    /**
     * Get the guard's name.
     *
     * @return string
     */
    public static function guardName(): string
    {
        return Auth::GUARD_WEB_USER;
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
    public function isDeletable(): bool
    {
        return true;
    }

    /**
     * Check if the model is not deletable.
     *
     * @return bool
     */
    public function isNotDeletable(): bool
    {
        return ! $this->isDeletable();
    }

    /**
     * Check if the current modal can impersonate other models.
     *
     * @return  bool
     */
    public function canImpersonate(): bool
    {
        return false;
    }

    /**
     * Check if the current model can be impersonated.
     *
     * @return  bool
     */
    public function canBeImpersonated(): bool
    {
        return impersonator()->isEnabled();
    }
}
