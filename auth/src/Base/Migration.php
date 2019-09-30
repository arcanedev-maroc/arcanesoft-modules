<?php namespace Arcanesoft\Auth\Base;

use Arcanedev\Support\Database\Migration as BaseMigration;
use Arcanesoft\Auth\Auth;

/**
 * Class     Migration
 *
 * @package  Arcanesoft\Auth\Base
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class Migration extends BaseMigration
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Migration constructor.
     */
    public function __construct()
    {
        $this->setConnection(Auth::config('database.connection'));
        $this->setPrefix(Auth::config('database.prefix'));
    }
}
