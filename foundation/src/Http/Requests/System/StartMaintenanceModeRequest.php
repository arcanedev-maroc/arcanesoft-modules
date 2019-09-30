<?php namespace Arcanesoft\Foundation\Http\Requests\System;

use Arcanesoft\Foundation\Http\Requests\FormRequest;

/**
 * Class     StartMaintenanceModeRequest
 *
 * @package  Arcanesoft\Foundation\Http\Requests\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class StartMaintenanceModeRequest extends FormRequest
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the validation rules.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'message'          => ['nullable', 'string'],
            'retry'            => ['nullable', 'integer', 'min:0'],
            'allowed'          => ['nullable', 'string'],
            'allow_current_ip' => ['boolean'],
            'ips.*'            => ['nullable', 'ip'],
        ];
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'ips' => $this->parseIPs(),
        ]);
    }

    /**
     * Parse the allowed IPs into an array.
     *
     * @return array
     */
    private function parseIPs(): array
    {
        $ips = explode(PHP_EOL, $this->get('allowed', ''));

        if ((bool) $this->get('allow_current_ip'))
            $ips[] = $this->ip();

        return array_unique(array_filter($ips));
    }
}
