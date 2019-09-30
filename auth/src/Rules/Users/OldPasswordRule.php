<?php namespace Arcanesoft\Auth\Rules\Users;

use Arcanesoft\Auth\Repositories\UsersRepository;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

/**
 * Class     OldPasswordRule
 *
 * @package  Arcanesoft\Auth\Rules\Users
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class OldPasswordRule implements Rule
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  int */
    private $userId;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * OldPasswordRule constructor.
     *
     * @param  int  $userId
     */
    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed   $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = (new UsersRepository)->find($this->userId);

        return $user !== null
            && Hash::check($value, $user->password);
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return __('Your old password is not valid');
    }
}
