<?php namespace Arcanesoft\Foundation\Events\UI;

/**
 * Class     SkinModeToggled
 *
 * @package  Arcanesoft\Foundation\Events\UI
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SkinModeToggled
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /** @var array */
    public $options;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct(array $options)
    {
        $this->options = $options;
    }
}
