<?php namespace Arcanesoft\Foundation\ViewComposers\System;

use Illuminate\Contracts\View\View;

/**
 * Class     RequiredPhpExtensionsComposer
 *
 * @package  Arcanesoft\Foundation\ViewComposers\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class RequiredPhpExtensionsComposer
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const VIEW = 'foundation::system._composers.required-php-extensions';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Compose the view.
     *
     * @param  \Illuminate\Contracts\View\View  $view
     */
    public function compose(View $view)
    {
        $view->with('requiredPhpExtensions', static::getRequiredExtensions([
            'mbstring',
            'openssl',
            'pdo',
            'tokenizer',
            'xml',
        ]));
    }

    /**
     * Get the composed views.
     *
     * @return string|array
     */
    public static function views()
    {
        return self::VIEW;
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the required extension (check also if loaded).
     *
     * @param  array  $extensions
     *
     * @return array
     */
    protected static function getRequiredExtensions(array $extensions): array
    {
        return array_map(function ($extension) {
            return extension_loaded($extension);
        }, array_combine($extensions, $extensions));
    }
}
