<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Requests\Admins;

use Arcanesoft\Foundation\Auth\Http\Routes\AdministratorsRoutes;
use Arcanesoft\Foundation\Auth\Rules\Users\UserEmailRule;

/**
 * Class     UpdateAdminRequest
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Requests\Admins
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UpdateAdministratorRequest extends AdminFormRequest
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
        $user = $this->getCurrentAdministrator();

        return [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name'  => ['required', 'string', 'max:50'],
            'email'      => ['required', 'string', 'email', 'max:255', UserEmailRule::unique()->ignore($user->id)],
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
     * @return \Arcanesoft\Foundation\Auth\Models\User|mixed
     */
    protected function getCurrentAdministrator()
    {
        return $this->route()->parameter(AdministratorsRoutes::ADMIN_WILDCARD);
    }
}
