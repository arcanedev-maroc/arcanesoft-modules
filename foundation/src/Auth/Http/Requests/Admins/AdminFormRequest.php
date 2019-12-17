<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Requests\Admins;

use Arcanesoft\Foundation\Auth\Http\Requests\FormRequest;

/**
 * Class     AdminFormRequest
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Requests\Admins
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class AdminFormRequest extends FormRequest
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the validated data.
     *
     * @return array
     */
    public function getValidatedData(): array
    {
        return $this->only([
            'first_name',
            'last_name',
            'email',
            'password',
            'roles',
        ]);
    }
}