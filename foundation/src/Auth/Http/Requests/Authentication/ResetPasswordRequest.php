<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;
use Arcanesoft\Foundation\Fortify\Rules\Password;

/**
 * Class     ResetPasswordRequest
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ResetPasswordRequest extends FormRequest
{
    /**
     * Validation's rules.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'token'    => ['required'],
            'email'    => ['required', 'email'],
            'password' => ['required', 'string', new Password, 'confirmed'],
        ];
    }
}
