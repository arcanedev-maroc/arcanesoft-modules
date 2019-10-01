<?php

namespace Arcanesoft\Auth\Repositories;

use Arcanesoft\Auth\Auth;
use Arcanesoft\Auth\Models\User;
use Illuminate\Support\{Arr, Str};

/**
 * Class     UsersRepository
 *
 * @package  Arcanesoft\Auth\Repositories
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UsersRepository extends Respository
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
    public function model()
    {
        return Auth::makeModel('user');
    }

    /**
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
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Create a new user.
     *
     * @param  array  $attributes
     *
     * @return \Arcanesoft\Auth\Models\User
     */
    public function create(array $attributes)
    {
        $roles = Arr::pull($attributes, 'roles', []);

        $attributes['password'] = $attributes['password'] ?? Str::random(8);

        return tap($this->query()->create($attributes), function ($user) use ($roles) {
            /** @var  \Arcanesoft\Auth\Models\User  $user */
            $user->syncRoles($roles, false);
        });
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
        $attributes = array_filter($attributes); // Remove the nullable attributes

        $user->update($attributes);

        if (isset($attributes['roles']))
            $user->syncRoles($attributes['roles'], false);

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
            ? $user->deactivate()
            : $user->activate();
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
