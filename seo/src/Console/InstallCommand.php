<?php

declare(strict_types=1);

namespace Arcanesoft\Seo\Console;

use Arcanesoft\Seo\Seeders\DatabaseSeeder;
use Illuminate\Console\Command;

/**
 * Class     InstallCommand
 *
 * @package  Arcanesoft\Seo\Console
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class InstallCommand extends Command
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    protected $signature = 'seo:install';

    protected $description = 'Install SEO module';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function handle()
    {
        $this->comment('Installing SEO Module');

        $this->call('db:seed', ['--class' => DatabaseSeeder::class]);

        $this->comment('SEO Module installed !');
        $this->line('');
    }
}
