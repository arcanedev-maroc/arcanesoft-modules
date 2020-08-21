<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Requests\Users;

use Arcanesoft\Foundation\Auth\Rules\Users\EmailRule;

/**
 * Class     CreateUserRequest
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Requests\Users
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CreateUserRequest extends UserFormRequest
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the validation's rules.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name'  => ['required', 'string', 'max:50'],
            'email'      => ['required', 'string', 'email', 'max:255', EmailRule::unique()],
            'password'   => ['nullable', 'string', 'min:8', 'confirmed'],
        ];
    }
}
