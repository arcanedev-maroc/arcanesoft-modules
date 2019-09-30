<?php namespace Arcanesoft\Media\Console;

use Arcanesoft\Media\Seeders\DatabaseSeeder;
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

    protected $signature = 'media:install';

    protected $description = 'Install Media module';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function handle()
    {
        $this->comment('Installing Media Module');

        $this->call('db:seed', ['--class' => DatabaseSeeder::class]);

        $this->comment('Media Module installed !');
        $this->line('');
    }
}
