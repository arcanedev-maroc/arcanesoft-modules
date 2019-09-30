<?php namespace Arcanesoft\Auth\Http\Requests\Users;



use Arcanesoft\Auth\Http\Routes\UsersRoutes;
use Arcanesoft\Auth\Rules\Users\UserEmailRule;

/**
 * Class     UpdateUserRequest
 *
 * @package  Arcanesoft\Auth\Http\Requests\Users
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UpdateUserRequest extends UserFormRequest
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
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name'  => ['required', 'string', 'max:50'],
            'email'      => ['required', 'string', 'email', 'max:255', UserEmailRule::unique()->ignore($this->getCurrentUser()->id)],
            'password'   => ['nullable', 'string', 'min:8', 'confirmed'],
            'roles'      => ['array'],
        ];
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the current user.
     *
     * @return \Arcanesoft\Auth\Models\User|mixed
     */
    protected function getCurrentUser()
    {
        return $this->route()->parameter(UsersRoutes::USER_WILDCARD);
    }
}
