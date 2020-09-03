<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation;

use Composer\Script\Event;
use Illuminate\Foundation\Application;

/**
 * Class     ComposerScripts
 *
 * @package  Arcanesoft\Foundation
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ComposerScripts
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the post-autoload-dump Composer event.
     *
     * @param  \Composer\Script\Event  $event
     */
    public static function postAutoloadDump(Event $event): void
    {
        require_once $event->getComposer()->getConfig()->get('vendor-dir').'/autoload.php';

        static::clearCompiled($event);
    }

    /**
     * Handle the post-update Composer event.
     *
     * @param  \Composer\Script\Event  $event
     */
    public static function clearCompiled(Event $event): void
    {
        $laravel = new Application(getcwd());

        if (is_file($arcanesoft = $laravel->bootstrapPath('cache/arcanesoft.php'))) {
            @unlink($arcanesoft);
        }
    }
}
