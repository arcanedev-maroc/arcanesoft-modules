<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Console;

use Arcanesoft\Foundation\Auth\Console\InstallCommand as AuthInstallCommand;
use Arcanesoft\Foundation\Core\Console\InstallCommand as CoreInstallCommand;
use Arcanesoft\Foundation\Support\Console\InstallCommand as Command;
use Arcanesoft\Foundation\System\Console\InstallCommand as SystemInstallCommand;

/**
 * Class     InstallCommand
 *
 * @package  Arcanesoft\Foundation\Console
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class InstallCommand extends Command
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'arcanesoft:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install ARCANESOFT';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the command.
     */
    public function handle(): void
    {
        $this->line('');

        $this->install();
        $this->installModules();

        $this->line('');
        $this->info('The ARCANESOFT installation was completed !');
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Install ARCANESOFT's Foundation.
     */
    protected function install()
    {
        return $this->callMany([
            CoreInstallCommand::class,
            AuthInstallCommand::class,
            SystemInstallCommand::class,
        ]);
    }

    /**
     * Install ARCANESOFT's modules.
     */
    protected function installModules(): void
    {
        $this->comment('Seeding all modules...');

        $commands = $this->laravel
            ->get('config')
            ->get('arcanesoft.foundation.modules.commands.install', []);

        $this->callMany($commands);

        $this->info('Database seeding completed successfully.');
    }
}
