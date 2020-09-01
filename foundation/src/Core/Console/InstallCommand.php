<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Console;

use Illuminate\Console\Command;

/**
 * Class     SetupCommand
 *
 * @package  Arcanesoft\Foundation\Core\Console
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
    protected $description = 'Setup ARCANESOFT';

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

        $this->runSeeders();

        $this->line('');
        $this->info('The ARCANESOFT setup is completed !');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Run the seeders.
     */
    private function runSeeders(): void
    {
        $this->comment('Seeding all modules...');

        foreach ($this->getSeeders() as $class) {
            $this->line('<info>Seeding:</info> '.$class);
            $this->callSilent('db:seed', ['--class' => $class]);
        }

        $this->info('Database seeding completed successfully.');
    }

    /**
     * Get the seeders.
     *
     * @return array
     */
    private function getSeeders(): array
    {
        return $this->laravel
            ->get('config')
            ->get('arcanesoft.foundation.modules.commands.setup.seeders', []);
    }
}
