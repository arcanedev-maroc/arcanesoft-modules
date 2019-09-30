<?php namespace Arcanesoft\Foundation\Http\Requests\Profile;

use Arcanesoft\Auth\Rules\Users\UserEmailRule;
use Arcanesoft\Foundation\Http\Requests\FormRequest;

/**
 * Class     UpdateUserAccountRequest
 *
 * @package  Arcanesoft\Foundation\Http\Requests\Profile
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UpdateUserAccountRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:50'],
            'last_name'  => ['required', 'string', 'max:50'],
            'email'      => ['required', 'string', 'email', 'max:255', UserEmailRule::unique()->ignore($this->user()->id)],
        ];
    }

    public function getValidatedData()
    {
        return $this->all([
            'first_name',
            'last_name',
            'email',
        ]);
    }
}
