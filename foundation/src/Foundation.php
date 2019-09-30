<?php namespace Arcanesoft\Foundation;

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

    const VERSION = '3.0.0';

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
    public function template()
    {
        return 'foundation::_template.master';
    }
}
