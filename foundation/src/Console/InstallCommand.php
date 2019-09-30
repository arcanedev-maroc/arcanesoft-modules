<?php namespace Arcanesoft\Foundation\Console;

use Arcanesoft\Foundation\Seeders\DatabaseSeeder;
use Illuminate\Console\Command;

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

    protected $signature = 'foundation:install';

    protected $description = 'Install Foundation module';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function handle()
    {
        $this->comment('Installing Foundation Module');

        $this->call('db:seed', ['--class' => DatabaseSeeder::class]);

        $this->comment('Foundation Module installed !');
        $this->line('');
    }
}
