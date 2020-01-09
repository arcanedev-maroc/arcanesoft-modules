<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Models;

use Arcanedev\LaravelImpersonator\Contracts\Impersonatable;
use Arcanedev\LaravelImpersonator\Traits\CanImpersonate;
use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Auth\Events\Users\CreatedUser;
use Arcanesoft\Foundation\Auth\Events\Users\CreatingUser;
use Arcanesoft\Foundation\Auth\Events\Users\DeletedUser;
use Arcanesoft\Foundation\Auth\Events\Users\DeletingUser;
use Arcanesoft\Foundation\Auth\Events\Users\ForceDeletedUser;
use Arcanesoft\Foundation\Auth\Events\Users\ReplicatingUser;
use Arcanesoft\Foundation\Auth\Events\Users\RestoredUser;
use Arcanesoft\Foundation\Auth\Events\Users\RestoringUser;
use Arcanesoft\Foundation\Auth\Events\Users\RetrievedUser;
use Arcanesoft\Foundation\Auth\Events\Users\SavedUser;
use Arcanesoft\Foundation\Auth\Events\Users\SavingUser;
use Arcanesoft\Foundation\Auth\Events\Users\UpdatedUser;
use Arcanesoft\Foundation\Auth\Events\Users\UpdatingUser;
use Arcanesoft\Foundation\Auth\Models\Concerns\Activatable;
use Arcanesoft\Foundation\Auth\Models\Presenters\UserPresenter;
use Illuminate\Database\Eloquent\{Builder, Relations\HasMany, SoftDeletes};
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class     User
 *
 * @package  Arcanesoft\Foundation\Auth\Models
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
 * @property  \Illuminate\Support\Carbon  last_activity_at
 * @property  \Illuminate\Support\Carbon  created_at
 * @property  \Illuminate\Support\Carbon  updated_at
 * @property  \Illuminate\Support\Carbon  deleted_at
 *
 * @property  \Illuminate\Database\Eloquent\Collection  permissions
 *
 * @method  static|\Illuminate\Database\Eloquent\Builder  filterByAuthenticatedUser(User $user)
 * @method  static|\Illuminate\Database\Eloquent\Builder  verifiedEmail()
 */
class User extends Authenticatable implements Impersonatable
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use UserPresenter,
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
     * Get the socialite providers' relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function providers(): HasMany
    {
        return $this->hasMany(SocialiteProvider::class);
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
        return true;
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

    /**
     * Check if the user has a registered social provider.
     *
     * @param  string  $provider
     *
     * @return bool
     */
    public function hasProvider(string $provider): bool
    {
        return $this->providers()
            ->where('provider_type', $provider)
            ->exists();
    }
}
