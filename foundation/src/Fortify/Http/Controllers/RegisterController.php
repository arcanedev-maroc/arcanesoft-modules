<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Fortify\Http\Controllers;

use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Fortify\Concerns\HasGuard;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Response;

/**
 * Class     RegisterController
 *
 * @package  Arcanesoft\Foundation\Fortify\Http\Controllers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class RegisterController
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasGuard;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Register the new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array                     $data
     *
     * @return mixed
     */
    protected function register($request, array $data)
    {
        $user = $this->createUser($data);

        event(new Registered($user));

        if ($this->shouldLoginUser($request, $user)) {
            $this->auth()->login($user);
        }

        return $this->getRegisteredResponse($request, $user);
    }

    /**
     * Create a new user.
     *
     * @param  array  $data
     *
     * @return mixed
     */
    abstract protected function createUser(array $data);

    /**
     * Determine if the registered user should be logged in.
     *
     * @param  \Illuminate\Http\Request                 $request
     * @param  \Arcanesoft\Foundation\Auth\Models\User  $user
     *
     * @return bool
     */
    protected function shouldLoginUser($request, $user): bool
    {
        return Auth::isLoginEnabled();
    }

    /**
     * Get the registered response.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return mixed
     */
    protected function getRegisteredResponse($request, $user)
    {
        if ($request->wantsJson())
            new Response('', Response::HTTP_CREATED);

        return redirect()->to($this->redirectUrlAfterRegister($request, $user));
    }

    /**
     * Get the redirect url after user was registered.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return string
     */
    abstract protected function redirectUrlAfterRegister($request, $user): string;
}
