<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation;

/**
 * Class     Foundation
 *
 * @package  Arcanesoft\Foundation
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Foundation
{
    /* -----------------------------------------------------------------
     |  Constants
     | -----------------------------------------------------------------
     */

    const VERSION = '4.0.0';

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Indicates if migrations will be run.
     *
     * @var bool
     */
    public static $runsMigrations = true;

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the version.
     *
     * @return string
     */
    public function version(): string
    {
        return static::VERSION;
    }

    /**
     * Get the template path.
     *
     * @return string
     */
    public function template(): string
    {
        return 'foundation::_template.master';
    }
}
