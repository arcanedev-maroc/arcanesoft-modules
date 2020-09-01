<?php

declare(strict_types=1);

namespace Arcanesoft\Seo\Console;

use Arcanesoft\Seo\Database\DatabaseSeeder;
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

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo:install';

    /**
     * The console command description.
     *
     * @var string|null
     */
    protected $description = 'Install SEO module';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the command.
     */
    public function handle(): void
    {
        $this->comment('Installing SEO Module');

        $this->call('db:seed', ['--class' => DatabaseSeeder::class]);

        $this->comment('SEO Module installed !');
        $this->line('');
    }
}
