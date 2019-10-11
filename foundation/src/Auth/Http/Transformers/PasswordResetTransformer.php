<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Http\Transformers;

use Arcanesoft\Foundation\Auth\Models\PasswordReset;

/**
 * Class     PasswordResetTransformer
 *
 * @package  Arcanesoft\Foundation\Auth\Http\Transformers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PasswordResetTransformer extends AbstractTransformer
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Transform the response.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\PasswordReset  $reset
     *
     * @return array
     */
    public function transform(PasswordReset $reset): array
    {
        return [
            'email'      => $reset->email,
            'created_at' => '<small>'.$reset->created_at.'</small>',
            'actions'     => static::renderActions([
                //
            ]),
        ];
    }
}
