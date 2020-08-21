<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\ConfirmsPasswords;

/**
 * Class     ConfirmPasswordController
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Controllers\Auth
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ConfirmPasswordController extends Controller
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use ConfirmsPasswords;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Display the password confirmation view.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showConfirmForm()
    {
        if ( ! $this->shouldConfirmPassword())
            return redirect()->to($this->redirectTo());

        return view('foundation::auth.passwords.confirm');
    }

    /**
     * Get the password confirmation validation rules.
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'password' => [
                'required',
                'password:admin',
            ],
        ];
    }

    /**
     * Check if should confirm password.
     *
     * @return bool
     */
    protected function shouldConfirmPassword(): bool
    {
        $confirmedAt = time() - session()->get('auth.password_confirmed_at');

        return $confirmedAt > config('auth.password_timeout', 10800);
    }

    /**
     * Get the redirect to url.
     *
     * @return string
     */
    protected function redirectTo(): string
    {
        return route('admin::index');
    }
}
