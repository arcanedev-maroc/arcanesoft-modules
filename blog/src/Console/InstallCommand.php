<?php

declare(strict_types=1);

namespace Arcanesoft\Blog\Console;

use Arcanesoft\Blog\Seeders\DatabaseSeeder;
use Illuminate\Console\Command;

/**
 * Class     InstallCommand
 *
 * @package  Arcanesoft\Blog\Console
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class InstallCommand extends Command
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    protected $signature = 'blog:install';

    protected $description = 'Install Blog module';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function handle()
    {
        $this->comment('Installing Blog Module');

        $this->call('db:seed', ['--class' => DatabaseSeeder::class]);

        $this->comment('Blog Module installed !');
        $this->line('');
    }
}
