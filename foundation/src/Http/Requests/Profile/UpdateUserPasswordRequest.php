<?php namespace Arcanesoft\Foundation\Http\Requests\Profile;

use Arcanesoft\Auth\Rules\Users\OldPasswordRule;
use Arcanesoft\Foundation\Http\Requests\FormRequest;

/**
 * Class     UpdateUserPasswordRequest
 *
 * @package  Arcanesoft\Foundation\Http\Requests\Profile
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UpdateUserPasswordRequest extends FormRequest
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => ['required', 'string', 'min:8', new OldPasswordRule($this->user()->id)],
            'password'     => ['required', 'string', 'min:8', 'different:old_password', 'confirmed'],
        ];
    }

    /**
     * Get the validated data.
     *
     * @return array
     */
    public function getValidatedData()
    {
        return $this->all([
            'password',
        ]);
    }
}
