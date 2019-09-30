<?php namespace Arcanesoft\Foundation\ViewComposers\System;

use Illuminate\Contracts\View\View;

/**
 * Class     FoldersPermissionsComposer
 *
 * @package  Arcanesoft\Foundation\ViewComposers\System
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class FoldersPermissionsComposer
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const VIEW = 'foundation::system._composers.folders-permissions';

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
        $view->with('foldersPermissions', static::getFoldersPermissions([
            'bootstrap/',
            'bootstrap/cache/',
            'storage/app/',
            'storage/framework/',
            'storage/logs/',
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
     * Get the folder permissions.
     *
     * @param  array  $folders
     *
     * @return array
     */
    protected static function getFoldersPermissions(array $folders): array
    {
        return array_map(function ($folder) {
            $path = base_path($folder);

            return [
                'path'     => $path,
                'chmod'    => (int) substr(sprintf('%o', fileperms($path)), -4),
                'writable' => is_writable($path),
            ];
        }, array_combine($folders, $folders));
    }
}
