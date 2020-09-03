<?php

declare(strict_types=1);

namespace Arcanesoft\Passport\Console;

use Arcanesoft\Foundation\Support\Console\InstallCommand as Command;
use Arcanesoft\Passport\Database\DatabaseSeeder;

/**
 * Class     InstallCommand
 *
 * @package  Arcanesoft\Passport\Console
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class InstallCommand extends Command
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the command.
     */
    public function handle(): void
    {
        $this->seed(DatabaseSeeder::class);
    }
}
