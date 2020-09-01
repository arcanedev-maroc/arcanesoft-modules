<?php

declare(strict_types=1);

namespace Arcanesoft\Media\Console;

use Arcanesoft\Media\Database\DatabaseSeeder;
use Illuminate\Console\Command;

/**
 * Class     InstallCommand
 *
 * @package  Arcanesoft\Media\Console
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
    protected $signature = 'media:install';

    /**
     * The console command description.
     *
     * @var string|null
     */
    protected $description = 'Install Media module';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the command.
     */
    public function handle(): void
    {
        $this->comment('Installing Media Module');

        $this->call('db:seed', ['--class' => DatabaseSeeder::class]);

        $this->comment('Media Module installed !');
        $this->line('');
    }
}
