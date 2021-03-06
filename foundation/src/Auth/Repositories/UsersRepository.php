<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Repositories;

use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Auth\Events\Users\{
    ActivatedUser, ActivatingUser, DeactivatedUser, DeactivatingUser, SyncedRolesToUser, SyncingRolesToUser,
};
use Arcanesoft\Foundation\Auth\Models\Role;
use Arcanesoft\Foundation\Auth\Models\User;
use Illuminate\Support\{Collection, Str};
use Illuminate\Database\Eloquent\Builder;

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
     * Get the model instance.
     *
     * @return \Arcanesoft\Foundation\Auth\Models\User|mixed
     */
    public static function model(): User
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
     * Create a new user with `member` role.
     *
     * @param  array  $attributes
     *
     * @return \Arcanesoft\Foundation\Auth\Models\User
     */
    public function createMember(array $attributes): User
    {
        return tap($this->createUser($attributes), function (User $user) {
            $this->syncRolesByKeys($user, [Role::MEMBER]);
        });
    }

    /**
     * Create a new user.
     *
     * @param  array  $attributes
     *
     * @return \Arcanesoft\Foundation\Auth\Models\User
     */
    public function createUser(array $attributes): User
    {
        $attributes['password'] = $attributes['password'] ?? Str::random(8);

        $user = $this->fill($attributes)->forceFill([
            'activated_at' => $attributes['activated_at'] ?: now(), // TODO: Add a setting to change this
        ]);

        $user->save();

        return $user;
    }

    /**
     * Create a new user.
     *
     * @param  array  $attributes
     *
     * @return \Arcanesoft\Foundation\Auth\Models\User|mixed
     */
    public function create(array $attributes): User
    {
        $attributes['password'] = $attributes['password'] ?? Str::random(8);

        return parent::create($attributes);
    }

    /**
     * Update an existed user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User  $user
     * @param  array                                    $attributes
     *
     * @return \Arcanesoft\Foundation\Auth\Models\User
     */
    public function update(User $user, array $attributes): User
    {
        // Remove the nullable attributes (like leaving password null to skip the update)
        $attributes = array_filter($attributes);

        $user->update($attributes);

        return $user;
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
            ? $this->deactivate($user)
            : $this->activate($user);
    }

    /**
     * Activate the given user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User  $user
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
     * @param  \Arcanesoft\Foundation\Auth\Models\User  $user
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
     * @param  \Arcanesoft\Foundation\Auth\Models\User  $user
     *
     * @return bool|null
     */
    public function delete(User $user)
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
    public function restore(User $user)
    {
        return $user->restore();
    }

    /**
     * Sync roles by keys.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User  $user
     * @param  array                         $keys
     *
     * @return array
     */
    public function syncRolesByKeys(User $user, array $keys): array
    {
        return $this->syncRoles(
            $user, $this->getRolesRepository()->getByKeys($keys)
        );
    }

    /**
     * Sync roles by uuids.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User  $user
     * @param  array                                    $uuids
     *
     * @return array
     */
    public function syncRolesByUuids(User $user, array $uuids): array
    {
        return $this->syncRoles(
            $user, $this->getRolesRepository()->getByUuids($uuids)
        );
    }

    /**
     * Sync roles with the user.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\User  $user
     * @param  \Illuminate\Support\Collection           $roles
     *
     * @return array
     */
    public function syncRoles(User $user, Collection $roles): array
    {
        if (empty($roles))
            return [];

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

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */


    /**
     * Get the roles repository.
     *
     * @return \Arcanesoft\Foundation\Auth\Repositories\RolesRepository|mixed
     */
    protected function getRolesRepository(): RolesRepository
    {
        return static::getRepository(RolesRepository::class);
    }
}
