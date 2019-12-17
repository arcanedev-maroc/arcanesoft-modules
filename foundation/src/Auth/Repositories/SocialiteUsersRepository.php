<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Repositories;

use Arcanesoft\Foundation\Auth\{Auth, Socialite};
use Arcanesoft\Foundation\Auth\Models\SocialiteProvider;
use Illuminate\Http\Response;

/**
 * Class     SocialiteUsersRepository
 *
 * @package  Arcanesoft\Foundation\Auth\Repositories
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SocialiteUsersRepository extends AbstractRepository
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
        return Auth::model('socialite-provider', SocialiteProvider::class);
    }

    /* -----------------------------------------------------------------
     |  CRUD Methods
     | -----------------------------------------------------------------
     */

    /**
     * Find or create user based on the given provider.
     *
     * @param  string  $provider
     *
     * @return \Arcanesoft\Foundation\Auth\Models\User
     */
    public function findOrCreateUser(string $provider)
    {
        $userData = Socialite::user($provider);

        // User email may not provided.
        $email = $userData->getEmail() ?: "{$userData->getId()}@{$provider}.com";

        $usersRepo = $this->getUsersRepository();

        /** @var  \Arcanesoft\Foundation\Auth\Models\User|null  $user */
        $user = $usersRepo->where('email', $email)->first();

        if ($user === null) {
            abort_unless(
                Auth::isRegistrationEnabled(),
                Response::HTTP_UNAUTHORIZED,
                __('Registration is currently disabled.')
            );

            // Get users first name and last name from their full name
            $nameParts = static::getNameParts($userData->getName());

            //TODO: Add Activated + Confirmed

            $user = $usersRepo->createOne([
                'first_name'  => $nameParts['first_name'],
                'last_name'   => $nameParts['last_name'],
                'email'       => $email,
                'avatar'      => $userData->getAvatar(),
                'password'    => null,
            ]);

//            event(new UserProviderRegistered($user));
        }

        if ($user->hasProvider($provider)) {
            $user->providers()->update([
                'token' => $userData->token,
            ]);
            $usersRepo->updateOne($user, [
                'avatar' => $userData->getAvatar(),
            ]);
        }
        else {
            $user->providers()->save(new SocialiteProvider([
                'provider_type' => $provider,
                'provider_id'   => $userData->id,
                'token'         => $userData->token,
            ]));
        }

        return $user;
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the users repository.
     *
     * @return \Arcanesoft\Foundation\Auth\Repositories\UsersRepository|mixed
     */
    protected function getUsersRepository(): UsersRepository
    {
        return static::getRepository(UsersRepository::class);
    }

    /**
     * @param  string  $name
     *
     * @return array
     */
    protected static function getNameParts(string $name): array
    {
        $parts = array_values(array_filter(explode(' ', $name)));

        if (empty($parts)) {
            return [
                'first_name' => null,
                'last_name'  => null,
            ];
        }

        if (count($parts) === 1) {
            return [
                'first_name' => $parts[0],
                'last_name'  => null,
            ];
        }

        return [
            'first_name' => $parts[0],
            'last_name'  => $parts[1],
        ];
    }
}