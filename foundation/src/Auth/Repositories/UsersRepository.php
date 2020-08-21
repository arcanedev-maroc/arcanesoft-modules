<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Repositories;

use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Auth\Events\Users\{ActivatedUser, ActivatingUser, DeactivatedUser, DeactivatingUser};
use Arcanesoft\Foundation\Auth\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

/**
 * Class     UsersRepository
 *
 * @package  Arcanesoft\Auth\Repositories
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @mixin  \Arcanesoft\Foundation\Auth\Models\User
 */
class UsersRepository extends AbstractRepository
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the model FQN class.
     *
     * @return string
     */
    public static function modelClass(): string
    {
        return Auth::model('user', User::class);
    }

    /* -----------------------------------------------------------------
     |  Queries
     | -----------------------------------------------------------------
     */

    /**
     * Add a uuid where clause to the query.
     *
     * @param  string  $value
     *
     * @return \Illuminate\Database\Eloquent\Builder|mixed
     */
    public function whereUuid(string $value)
    {
        return $this->where('uuid', '=', $value);
    }

    /**
     * Scope only the trashed records.
     *
     * @param  bool  $condition
     *
     * @return \Arcanesoft\Foundation\Auth\Models\User|\Illuminate\Database\Eloquent\Builder
     */
    public function onlyTrashed(bool $condition = true)
    {
        return $this->when($condition, function (Builder $q) {
            return $q->onlyTrashed();
        });
    }

    /* -----------------------------------------------------------------
     |  CRUD Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the first user with the given uuid, or fails if not found.
     *
     * @param  string  $uuid
     *
     * @return \Arcanesoft\Foundation\Auth\Models\User|mixed
     */
    public function firstWhereUuidOrFail(string $uuid): User
    {
        return $this->where('uuid', '=', $uuid)
                    ->withTrashed() // Get also trashed records
                    ->firstOrFail();
    }

    /**
     * Create a new user.
     *
     * @param  array  $attributes
     *
     * @return \Arcanesoft\Foundation\Auth\Models\User
     */
    public function createOne(array $attributes): User
    {
        $attributes['password'] = $attributes['password'] ?? Str::random(8);

        return tap($this->model()->fill($attributes), function (User $user) use ($attributes) {
            $user->forceFill([
                'uuid'         => $attributes['uuid'] ?? Str::uuid(),
                'activated_at' => $attributes['activated_at'] ?? now(), // TODO: Add a setting to change this
            ]);

            $user->save();
        });
    }

    /**
     * Update the given user (+ synced roles).
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User  $user
     * @param  array                                    $attributes
     *
     * @return bool
     */
    public function updateOne(User $user, array $attributes): bool
    {
        return $user->update($attributes);
    }

    /**
     * Activate/Deactivate a user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User  $user
     *
     * @return bool
     */
    public function toggleActive(User $user): bool
    {
        return $user->isActive()
            ? $this->deactivateOne($user)
            : $this->activateOne($user);
    }

    /**
     * Activate the given user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User  $user
     *
     * @return bool
     */
    public function activateOne(User $user)
    {
        if ($user->isActive())
            return false;

        event(new ActivatingUser($user));
        $result = $user->forceFill(['activated_at' => $user->freshTimestamp()])->save();
        event(new ActivatedUser($user));

        return $result;
    }

    /**
     * Deactivate the given user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User  $user
     *
     * @return bool
     */
    public function deactivateOne(User $user): bool
    {
        if ( ! $user->isActive())
            return false;

        event(new DeactivatingUser($user));
        $result = $user->forceFill(['activated_at' => null])->save();
        event(new DeactivatedUser($user));

        return $result;
    }

    /**
     * Delete or Force delete a user if trashed.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User  $user
     *
     * @return bool|null
     */
    public function deleteOne(User $user)
    {
        return $user->trashed() ? $user->forceDelete() : $user->delete();
    }

    /**
     * Restore a user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User  $user
     *
     * @return bool|null
     */
    public function restoreOne(User $user)
    {
        if ( ! $user->trashed())
            return null;

        return $user->restore();
    }

    /* -----------------------------------------------------------------
     |  Count Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the active users count.
     *
     * @return int
     */
    public function activeCount(): int
    {
        return $this->activated()->count();
    }

    /**
     * Get the verified users count.
     *
     * @return int
     */
    public function verifiedCount(): int
    {
        return $this->verifiedEmail()->count();
    }

    /**
     * Get the trashed users count.
     *
     * @return int
     */
    public function trashedCount(): int
    {
        return $this->onlyTrashed()->count();
    }
}
