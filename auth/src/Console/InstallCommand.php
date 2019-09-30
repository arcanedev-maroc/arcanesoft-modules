<?php namespace Arcanesoft\Auth\Console;

use Arcanesoft\Auth\Seeders\DatabaseSeeder;
use Illuminate\Console\Command;

/**
 * Class     InstallCommand
 *
 * @package  Arcanesoft\Auth\Console
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class InstallCommand extends Command
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    protected $signature = 'auth:install';

    protected $description = 'Install Auth module';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function handle()
    {
        $this->comment('Installing Auth Module');

        $this->call('db:seed', ['--class' => DatabaseSeeder::class]);

        $this->comment('Auth Module installed !');
        $this->line('');
    }
}
