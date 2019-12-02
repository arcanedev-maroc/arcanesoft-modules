<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Requests\Admins;

use Arcanesoft\Foundation\Auth\Rules\Users\UserEmailRule;

/**
 * Class     CreateAdminRequest
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Requests\Admins
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CreateAdministratorRequest extends AdminFormRequest
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
            'email'      => ['required', 'string', 'email', 'max:255', UserEmailRule::unique()],
            'password'   => ['nullable', 'string', 'min:8', 'confirmed'],
            'roles'      => ['array'],
        ];
    }
}