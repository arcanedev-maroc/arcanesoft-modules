<?php

namespace Arcanesoft\Auth\Repositories;

use Arcanesoft\Auth\Auth;
use Arcanesoft\Auth\Events\Users\{
    ActivatedUser,
    ActivatingUser,
    DeactivatedUser,
    DeactivatingUser,
    SyncedRolesToUser,
    SyncingRolesToUser};
use Arcanesoft\Auth\Models\User;
use Illuminate\Support\{
    Arr,
    Str};

/**
 * Class     UsersRepository
 *
 * @package  Arcanesoft\Auth\Repositories
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UsersRepository extends Repository
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the model instance.
     *
     * @return \App\Models\User|\Arcanesoft\Auth\Models\User|mixed
     */
    public static function model()
    {
        return Auth::makeModel('user');
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
        return $this->query()->where('uuid', '=', $value);
    }

    /**
     * Scope only the trashed records.
     *
     * @param  bool  $condition
     *
     * @return \Arcanesoft\Auth\Models\User|\Illuminate\Database\Eloquent\Builder
     */
    public function onlyTrashed(bool $condition = true)
    {
        return $this->query()->when($condition, function ($q) {
            return $q->onlyTrashed();
        });
    }

    /* -----------------------------------------------------------------
     |  CRUD Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get first user with the given uuid, or fails.
     *
     * @param  string  $uuid
     *
     * @return \Arcanesoft\Auth\Models\User|mixed
     */
    public function firstOrFailWhereUuid(string $uuid)
    {
        return $this->query()
            ->where('uuid', '=', $uuid)
            ->withTrashed() // Get also trashed records
            ->firstOrFail();
    }

    /**
     * Create a new user.
     *
     * @param  array  $attributes
     *
     * @return \Arcanesoft\Auth\Models\User|mixed
     */
    public function create(array $attributes)
    {
        $roles = Arr::pull($attributes, 'roles', []);
        $attributes['password'] = $attributes['password'] ?? Str::random(8);

        return tap($this->query()->create($attributes), function (User $user) use ($roles) {
            $this->syncRoles($user, $roles);
        });
    }

    /**
     * Force create a new user.
     *
     * @param array $attributes
     *
     * @return \Arcanesoft\Auth\Models\User|mixed
     */
    public function forceCreate(array $attributes)
    {
        return $this->query()->forceCreate($attributes);
    }

    /**
     * Update an existed user.
     *
     * @param  \Arcanesoft\Auth\Models\User  $user
     * @param  array                         $attributes
     *
     * @return \Arcanesoft\Auth\Models\User
     */
    public function update(User $user, array $attributes)
    {
        // Remove the nullable attributes
        $attributes = array_filter($attributes);

        $user->update($attributes);

        if (isset($attributes['roles']))
            $this->syncRoles($user, $attributes['roles']);

        return $user;
    }

    /**
     * Activate/Deactivate a user.
     *
     * @param  \Arcanesoft\Auth\Models\User  $user
     *
     * @return bool
     */
    public function toggleActive(User $user): bool
    {
        return $user->isActive()
            ? $this->deactivate($user)
            : $this->activate($user);
    }

    /**
     * Activate the given user.
     *
     * @param  \Arcanesoft\Auth\Models\User  $user
     *
     * @return bool
     */
    public function activate(User $user)
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
     * @param  \Arcanesoft\Auth\Models\User  $user
     *
     * @return bool
     */
    public function deactivate(User $user): bool
    {
        if ( ! $user->isActive())
            return false;

        event(new DeactivatingUser($user));
        $result = $user->forceFill(['activated_at' => null])->save();
        event(new DeactivatedUser($user));

        return $result;
    }

    /**
     * Delete a user.
     *
     * @param  \Arcanesoft\Auth\Models\User  $user
     *
     * @return bool|null
     */
    public function delete(User $user)
    {
        return $user->trashed()
            ? $user->forceDelete()
            : $user->delete();
    }

    /**
     * Restore a user.
     *
     * @param  \Arcanesoft\Auth\Models\User  $user
     *
     * @return bool|null
     */
    public function restore(User $user)
    {
        return $user->restore();
    }

    /**
     * Find a user by the given id.
     *
     * @param  int  $id
     *
     * @return \Arcanesoft\Auth\Models\User|mixed|null
     */
    public function find($id)
    {
        return $this->query()->find($id);
    }

    /**
     * Sync roles with the user.
     *
     * @param  \Arcanesoft\Auth\Models\User  $user
     * @param  iterable                      $roleKeys
     *
     * @return array
     */
    public function syncRoles(User $user, iterable $roleKeys): array
    {
        $roles = static::getRepository(RolesRepository::class)
            ->getByKeys($roleKeys);

        event(new SyncingRolesToUser($user, $roles));
        $synced = $user->roles()->sync($roles->pluck('id'));
        event(new SyncedRolesToUser($user, $roles, $synced));

        return $synced;
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
        return $this->query()->activated()->count();
    }

    /**
     * Get the verified users count.
     *
     * @return int
     */
    public function verifiedCount(): int
    {
        return $this->query()->verifiedEmail()->count();
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
